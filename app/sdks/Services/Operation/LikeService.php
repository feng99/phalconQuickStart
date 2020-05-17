<?php
/**
 * "点赞"操作服务类
 */

namespace App\Sdks\Services;

use App\Sdks\Constants\CounterConfig;
use App\Sdks\Constants\EventType;
use App\Sdks\Constants\McKey;
use App\Sdks\Constants\ObjType;
use App\Sdks\Constants\OperationType;
use App\Sdks\Constants\RedisKey;
use App\Sdks\Models\LikeModel;


class LikeService extends ServiceOperationBase
{
    /**
     * 点赞计数器类型
     *
     * @var int
     */
    protected $counter_type = CounterConfig::LIKE;


    /**
     * 构造函数
     *
     * @param string $uid
     * @param int    $obj_type
     */
    public function __construct($uid, $obj_type)
    {
        parent::__construct($uid, $obj_type);
    }

    /**
     * 获取对应的redis中的key
     *
     * @return string
     */
    protected function getOriginRedisKey()
    {
        return RedisKey::USER_LIKE_LOG;
    }

    /**
     * 获取点过赞的对象数据
     *
     * @param array $params
     * @param int $offset
     * @param int $limit
     * @return array
     */
    protected function getInitData($params, $offset = 0, $limit = 100) {
        $res = LikeModel::find([
            'columns' => 'obj_id, op_time',
            'conditions' => "uid = :uid: AND obj_type = :obj_type: AND is_like = 1",
            'bind' => [
                'uid' => $this->uid,
                'obj_type' => $this->obj_type
            ],
            "limit" => [
                "number" => $limit,
                "offset" => $offset
            ]
        ]);

        $ret = [];
        if ($res) {
            foreach ($res->toArray() as $val) {
                $tmp = [];
                $tmp['score'] = $val['op_time'];
                $tmp['value'] = $val['obj_id'];
                $ret[] = $tmp;
            }
        }
        return $ret;
    }

    /**
     * 保存数据
     *
     * @param $params
     * @param $option
     * @return bool
     */
    protected function saveData($params, $option) {
        $obj_id  = $params['obj_id'];
        $op_time = $params['op_time'];
        $data = LikeModel::findFirst([
            'conditions' => "uid=:uid: AND obj_id = :obj_id: AND obj_type = :obj_type:",
            'bind'       => [
                'uid' => $this->uid,
                'obj_id' => $obj_id,
                'obj_type' => $this->obj_type
            ]
        ]);

        if($data){
            $data->op_time = $op_time;
            $data->is_like = $option;
            $ret = $data->save();
        } else {
            $fm = new LikeModel();
            $fm->uid       = $this->uid;
            $fm->obj_id    = $obj_id;
            $fm->obj_type  = $this->obj_type;
            $fm->op_time   = $op_time;
            $fm->is_like   = $option;
            $ret = $fm->save();
        }
        return $ret;
    }

    /**
     * 后续自定义操作
     *
     * @param $option
     * @param $obj_id
     */
    protected function afterOperateFunc($option, $obj_id)
    {
        // 清除缓存
        $cache = self::getShared('');
        $key   = sprintf(McKey::POST_LIKE_USERS, $obj_id);
        $cache->delete($key);

        //发送通知
        if($option == OperationType::DO_IT) {
            $notice = new NoticeService();
            $notice->sendNoticeBefore(EventType::LIKE,$obj_id,$this->obj_type);
        }
    }

    /**
     * 获取对象的点赞人员列表
     *
     * @param $obj_id
     * @param $obj_type
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getLikeUids($obj_id, $obj_type, $limit = 10, $offset = 0) {
        $res = LikeModel::find([
            'conditions' => 'obj_id = ?1 AND obj_type = ?2 AND is_like = 1',
            'bind' => [
                1 => $obj_id,
                2 => $obj_type,
            ],
            'columns' => 'uid',
            'order' => 'op_time DESC',
            'limit' => [
                "number" => $limit,
                "offset" => $offset
            ]
        ]);

        $ret = [];
        if ($res) {
            $ret = $res->toArray();
        }
        return $ret;
    }
    
    /**
     * 是否操作对象
     *
     * @param  string  $uid
     * @param  string  $obj_id
     * @param  int     $obj_type
     * @return int
     */
    public static function isOperatedRedis($uid, $obj_id, $obj_type = ObjType::POST)
    {
        $class       = new static($uid, $obj_type);
        $is_operated = $class->isOperated($obj_id);
        
        return $is_operated;
    }

} 