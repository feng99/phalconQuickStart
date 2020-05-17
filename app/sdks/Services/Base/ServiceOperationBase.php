<?php
/**
 * 对象操作服务类
 * 点赞/收藏等操作
 */

namespace App\Sdks\Services\Base;

use App\Sdks\Constants\Base\OperationType;
use App\Sdks\Constants\Base\RedisKey;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Error\Handlers\CoreLogicErr;
use App\Sdks\Library\Error\Settings\System;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Services\Base\ServiceBase;

abstract class ServiceOperationBase extends ServiceBase
{
    /**
     * 操作用户ID
     *
     * @var string
     */
    protected $uid = '';

    /**
     * 操作的对象类型
     *
     * @var int
     */
    protected $obj_type = 0;

    /**
     * 操作发生的时间戳
     *
     * @var int
     */
    protected $op_time = 0;

    /**
     * 配置中的Redis key
     *
     * @var string
     */
    protected $redis_origin_key = '';

    /**
     * Redis中的实际key
     *
     * @var string
     */
    protected $redis_key = '';

    /**
     * Redis中的key的过期时间
     *
     * @var int
     */
    protected $redis_timeout = 0;

    /**
     * 放进zset中的初始化元素
     *
     * @var string
     */
    protected $init_element = [
        'score' => '-1',
        'value' => '-1'
    ];

    /**
     * 初始化读取数据长度
     *
     * @var int
     */
    protected $init_limit = 100;

    /**
     * 是否管理员
     *
     * @var bool
     */
    protected $is_admin = false;

    /**
     * 计数器类型
     *
     * @var null
     */
    protected $counter_type = null;

    /**
     * 是否允许操作的对象是本人
     *
     * @var bool
     */
    protected $allow_op_self = false;


    /**
     * 构造函数
     *
     * @param string $uid
     * @param int $obj_type
     */
    public function __construct($uid, $obj_type)
    {
        $this->uid              = $uid;
        $this->obj_type         = $obj_type;
        $this->redis_origin_key = $this->getOriginRedisKey();
        if (!array_key_exists($this->redis_origin_key, RedisKey::$SETTINGS)) {
            $err = Err::create(System::REDIS_KEY_NOT_CONFIGURED);
            ErrorHandle::throwErr($err);
        }
        $cfg                 = RedisKey::$SETTINGS[$this->redis_origin_key];
        $this->redis_timeout = $cfg['timeout'];

        // 执行初始化
        $this->init();
    }

    /**
     * 获取redis中的key
     *
     * @return string
     */
    abstract protected function getOriginRedisKey();

    /**
     * 初始化数据方法
     *
     * @param $params
     * @param $offset
     * @param $limit
     * @return mixed
     */
    abstract protected function getInitData($params, $offset, $limit);

    /**
     * 保存数据
     *
     * @param $params
     * @param $option
     * @return mixed
     */
    abstract protected function saveData($params, $option);


    /**
     * 获取redis中的key所需要的参数列表
     *
     * @return array
     */
    protected function getRedisKeyParams()
    {
        return [
            $this->uid,
            $this->obj_type,
        ];
    }

    /**
     * 生成最终的redis key
     *
     * @return mixed
     */
    protected function getRedisKey()
    {
        if (empty($this->redis_key)) {
            $params = $this->getRedisKeyParams();
            array_unshift($params, $this->redis_origin_key);
            $this->redis_key = call_user_func_array('sprintf', $params);
        }
        return $this->redis_key;
    }

    /**
     * 获取初始化函数需要的参数，子类按需进行重写
     *
     * @return array
     */
    protected function getInitParams()
    {
        return [
            'uid' => $this->uid,
        ];
    }

    /**
     * 初始化数据方法
     *
     * @return mixed
     */
    protected function init()
    {
        $redis_key = $this->getRedisKey();
        if ($this->redis->exists($redis_key)) {
            return true;
        }

        $offset      = 0;
        $limit       = $this->init_limit;
        $no_data     = false;
        $i           = 0;
        $init_params = $this->getInitParams();
        // 使用协程优化
        // todo
        do {
            $data = $this->getInitData($init_params, $offset, $limit);
            if ($data) {
                foreach ($data as $d) {
                    $params = [
                        $d['score'],
                        $d['value'],
                    ];
                    array_unshift($params, $redis_key);
                    call_user_func_array(array($this->redis, "zAdd"), $params);
                    $this->redis->expire($redis_key, $this->redis_timeout);
                }
            } else {
                // 没有数据则退出
                if ($i == 0) {
                    $no_data = true;
                    break;
                }
            }

            // 是否继续下一波数据
            if (count($data) < $limit) {
                break;
            }

            $offset += $limit;
            $i++;
        } while ($data);

        // 没有数据时创建key
        if ($no_data) {
            $this->redis->zAdd($redis_key, $this->init_element['score'], $this->init_element['value']);
            $this->redis->expire($redis_key, $this->redis_timeout);
        }
        return true;
    }

    /**
     * 做对应的操作
     *
     * @param int $option
     * @param mixed $obj_id
     * @return bool
     * @throws \ReflectionException
     */
    protected function operate($option, $obj_id)
    {
        // 校验参数
        if (!in_array($option, [OperationType::DO_IT, OperationType::UNDO])) {
            $err = new CoreLogicErr(CoreLogic::INVALID_PARAM);
            ErrorHandle::throwErr($err);
        }

        // 检查操作对象是否本人
        if ($this->uid == $obj_id) {
            ErrorHandle::throwErr(Err::create(CoreLogic::NOT_ALLOW_OPERATE_SELF));
        }

        // 检查操作的对象是否存在
        $this->checkExists($obj_id);

        // 已操作过直接返回
        $is_operated = $this->isOperated($obj_id);
        if ($is_operated == $option) {
            return true;
        }

        // 统一操作时间，作为redis的score值
        $this->op_time = \time();

        // 保存数据
        $params = [
            'obj_id'  => $obj_id,
            'op_time' => $this->op_time,
        ];
        $ret    = $this->saveData($params, $option);
        if ($ret) {
            // 处理后续操作
            $this->afterOperate($option, $obj_id);
        }
        return $ret ? true : false;
    }

    /**
     * 后续自定义操作
     *
     * @param $option
     * @param $obj_id
     */
    protected function afterOperateFunc($option, $obj_id) {}

    /**
     * 后续操作
     *
     * @param $option
     * @param $obj_id
     */
    protected function afterOperate($option, $obj_id)
    {
        // 更新redis
        $this->updateRedis($option, $obj_id);

        // 调用计数器
        $this->updateCounter($option, $obj_id);

        $this->afterOperateFunc($option, $obj_id);
    }

    /**
     * 调用计数器计数
     *
     * @param $option
     * @param $obj_id
     */
    protected function updateCounter($option, $obj_id) {
        if ($this->counter_type) {
            $counter = new CounterService([
                'counter_type' => $this->counter_type,
                'obj_id' => $obj_id,
                'obj_type' => $this->obj_type
            ]);
            if ($option == OperationType::DO_IT) {

                // 增加计数
                if(!$counter->key_is_invalid){
                    $counter->increase();
                }
            } else {
                // 减少计数
                $counter->decrease();
            }
        }
    }

    /**
     * 更新redis数据
     *
     * @param $option
     * @param $obj_id
     */
    protected function updateRedis($option, $obj_id)
    {
        $redis_key = $this->getRedisKey();
        if ($option == OperationType::DO_IT) {
            // 添加到集合[
            $this->redis->zAdd($redis_key, $this->op_time, $obj_id);
            $this->redis->expire($redis_key, $this->redis_timeout);
        } else {
            //从集合中删除
            $this->redis->zRem($redis_key, $obj_id);
        }

        // 移除初始化元素
        $this->removeInitElement();
    }

    /**
     * 判断对象是否存在，不存在抛出错误
     *
     * @param $obj_id
     * @return bool
     * @throws \ReflectionException
     */
    protected function checkExists($obj_id)
    {
        $obj   = new \ReflectionClass('App\Sdks\Constants\Base\ObjType');
        $types = $obj->getConstants();
        if ($type = array_search($this->obj_type, $types)) {
            $type  = CommonHelper::transToCamelCase(strtolower($type));
            $class = __NAMESPACE__ . '\\' . ucfirst($type) . 'Service';

            // 检查类是否存在
            if (!class_exists($class)) {
                ErrorHandle::throwErr(Err::create(System::CLASS_NOT_EXISTS, [$class]));
            }

            // 检查方法是否存在
            if (!method_exists($class, 'isExists')) {
                ErrorHandle::throwErr(Err::create(System::FUNCTION_NOT_EXISTS, [$class.'::isExists']));
            }

            // 调用方法校验
            $ret     = $class::isExists($obj_id);
            if (!$ret) {
                $err = Err::create(CoreLogic::OBJECT_NOT_EXISTS, [$this->obj_type, $obj_id]);
                ErrorHandle::throwErr($err);
            }
        } else {
            $err = Err::create(System::OBJ_TYPE_NOT_CONFIGURED, [$this->obj_type]);
            ErrorHandle::throwErr($err);
        }
    }

    /**
     * 判断是否含有初始化元素
     *
     * @return mixed
     */
    protected function hasInitElement()
    {
        $redis_key = $this->getRedisKey();
        return $this->redis->zScore($redis_key, $this->init_element['value']);
    }

    /**
     * 移除初始化元素
     *
     * @param array $arr
     * @return bool
     */
    protected function removeInitElement(&$arr = [])
    {
        $redis_key = $this->getRedisKey();
        if ($this->hasInitElement()) {
            // 大于1个元素时才移除
            if ($this->redis->zCard($redis_key) > 1) {
                $this->redis->zRem($redis_key, $this->init_element['value']);
            }
            // 从当前数组中移除
            if (isset($arr[$this->init_element['value']])) {
                unset($arr[$this->init_element['value']]);
            }
        }

        return true;
    }

    /**
     * 是否做过该操作
     *
     * @param $obj_id
     * @return int
     */
    public function isOperated($obj_id)
    {
        $redis_key   = $this->getRedisKey();
        $is_operated = true;
        if (false === $this->redis->zScore($redis_key, $obj_id)) {
            $is_operated = false;
        }

        return (int)$is_operated;
    }

    /**
     * 操作
     *
     * @param  $obj_id
     * @return bool
     * @throws \ReflectionException
     */
    public function doIt($obj_id)
    {
        return $this->operate(OperationType::DO_IT, $obj_id);
    }

    /**
     * 取消操作
     *
     * @param  $obj_id
     * @return bool
     * @throws \ReflectionException
     */
    public function undo($obj_id)
    {
        return $this->operate(OperationType::UNDO, $obj_id);
    }

    /**
     * 获取操作过的所有对象集合，返回关联数组
     * 注：返回的数组的key为obj_id，value为操作时间
     *
     * @return array
     */
    public function getAllObjects()
    {
        $redis_key = $this->getRedisKey();
        $ret       = $this->redis->zRange($redis_key, 0, -1, true);

        // 移除初始化元素
        $this->removeInitElement($ret);

        return $ret;
    }

    /**
     * 获取操作过的对象集合，可分页
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getObjects($offset = 0, $limit = 100)
    {
        $redis_key = $this->getRedisKey();
        $ret       = DiHelper::getRedis()->zRevRange($redis_key, $offset, $offset + $limit, true);

        // 移除初始化元素
        $this->removeInitElement($ret);

        return $ret;
    }


    /**
     * 获取所有操作过的对象数量
     *
     * @return int
     */
    public function getAllObjectsNum()
    {
        $redis_key = $this->getRedisKey();
        $res       = (int)$this->redis->zCard($redis_key);

        // 如果有初始化元素的存在，计算数目时需要减一
        if ($this->hasInitElement()) {
            $res = $res - 1;
        }

        return $res;
    }


}