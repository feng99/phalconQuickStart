<?php
/**
 * 计数器服务类
 */

namespace App\Sdks\Services\Base;

use App\Sdks\Constants\Base\CounterConfig;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Handlers\CoreLogicErr;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\LogHelper;

class CounterService extends ServiceBase
{
    /**
     * 增加操作
     */
    const OP_ADD = 1;

    /**
     * 减少操作
     */
    const OP_SUBTRACT = 2;

    /**
     * 计数类型
     *
     * @var int
     */
    private $counter_type = 0;

    /**
     * 对象类型
     *
     * @var int
     */
    private $obj_type = 0;

    /**
     * 对象ID
     *
     * @var int
     */
    private $obj_id = 0;

    /**
     * 步长
     *
     * @var int
     */
    private $step = 0;

    /**
     * 持久化时机
     *
     * @var int
     */
    private $persist_time = 0;

    /**
     * 缓存key
     *
     * @var string
     */
    private $cache_key = '';

    /**
     * 初始化函数
     *
     * @var string
     */
    private $init_func = '';

    /**
     * 更新函数
     *
     * @var string
     */
    private $update_func = '';

    /**
     * 是否恰好KEY过期或不存在
     */
    public $key_is_invalid = false;

    /**
     * 初始化操作
     *
     * CounterService constructor.
     * @param array $counter_data
     */
    public function __construct(array $counter_data)
    {
        $this->counter_type = $counter_data['counter_type'];
        $this->obj_type     = $counter_data['obj_type'];
        $this->obj_id       = $counter_data['obj_id'];


        // 获取配置
        if (!array_key_exists($this->counter_type, CounterConfig::$SETTINGS)) {
            LogHelper::error('counter.error.log', "Key not exists: " . $this->counter_type);
            return false;
        }
        $config             = CounterConfig::$SETTINGS[$this->counter_type][$this->obj_type];
        $this->step         = $config['step'];
        $this->persist_time = $config['persistence'];
        $this->init_func    = $config['init_func'];
        $this->update_func  = $config['update_func'];

        $cache_key = $config['key'];
        //key参数替换
        if (isset($counter_data['replace_key']) && is_array($counter_data['replace_key'])) {

            $args      = array_merge([$cache_key], $counter_data['replace_key']);
            $cache_key = call_user_func_array('sprintf', $args);

        } else {
            $cache_key = sprintf($cache_key, $this->obj_id);
        }

        $this->cache_key = $cache_key;
        // 初始化缓存
        $redis = DiHelper::getRedis();
        if (!$redis->exists($this->cache_key)) {
            $this->key_is_invalid = true;
            list($class, $method) = explode('::', $this->init_func);
            $arguments = [$this->obj_id, $this->cache_key];
            $res       = CommonHelper::callMethod($class, $method, $arguments);
            $set_res   = $redis->set($this->cache_key, $res);
            //如果redis无法set数据,异常邮件报警.
            if($set_res == false){
                LogHelper::error("redis error ,set failed ",$this->cache_key);
            }
        }
    }

    /**
     * 增加
     *
     * @return mixed
     */
    public function increase()
    {
        return $this->modifyNum(self::OP_ADD);
    }

    /**
     * 减少
     *
     * @return mixed
     */
    public function decrease()
    {
        return $this->modifyNum(self::OP_SUBTRACT);
    }

    /**
     * 设置step
     *
     * @param $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

    /**
     * 变更数量
     *
     * @param int $op
     * @return mixed
     */
    protected function modifyNum($op = self::OP_ADD)
    {
        // 写入redis
        if ($op == self::OP_ADD) {
            $num = $this->redis->incrBy($this->cache_key, $this->step);
            //防止计数器更新错误
            if($num < 1){
                $this->redis->del($this->cache_key);
                LogHelper::error('counter', "incrBy:cache_key:{$this->cache_key}=>num:{$num}");
                return false;
            }
        } else {
            //减操作时 获取当前操作值防止异常
            if ($this->getCurrentNum() < 1) {
                LogHelper::error('counter', "decrBy:cache_key:{$this->cache_key}");
                return false;
            }
            $num = $this->redis->decrBy($this->cache_key, $this->step);
        }

        // 异常情况
        if ($num < 0) {
            $err = new CoreLogicErr(CoreLogic::NUMBER_ERROR);
            ErrorHandle::throwErr($err);
        }

        // 持久化
        if ($num % $this->persist_time == 0) {
            if (!empty($this->update_func)) {
                list($class, $method) = explode('::', $this->update_func);
                $arguments = [$this->obj_id, $num, $this->cache_key];
                CommonHelper::callMethod($class, $method, $arguments);
            }
        }
        return $num;
    }

    /**
     * 获取当前最新的数量
     *
     * @return mixed
     */
    public function getCurrentNum()
    {
        return $this->redis->get($this->cache_key);
    }

    /**
     * 获取当前缓存key
     *
     * @return mixed
     */
    public function getCacheKey()
    {
        return $this->cache_key;
    }


}