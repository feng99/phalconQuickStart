<?php
/**
 * "收藏"操作服务类
 */

namespace App\Sdks\Services;

use App\Sdks\Constants\CounterConfig;
use App\Sdks\Constants\ObjType;
use App\Sdks\Constants\RedisKey;
use App\Sdks\Models\CollectModel;


class CollectService extends ServiceOperationBase
{

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
        return RedisKey::USER_COLLECT_LOG;
    }

    /**
     * 获取操作过的对象数据
     *
     * @param array $params
     * @param int $offset
     * @param int $limit
     * @return array
     */
    protected function getInitData($params, $offset = 0, $limit = 100) {
        $res = CollectModel::find([
            'columns' => 'obj_id, op_time',
            'conditions' => "uid = :uid: AND obj_type = :obj_type: AND is_collected = 1",
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
        $data = CollectModel::findFirst([
            'conditions' => "uid=:uid: AND obj_id = :obj_id: AND obj_type = :obj_type:",
            'bind'       => [
                'uid' => $this->uid,
                'obj_id' => $obj_id,
                'obj_type' => $this->obj_type
            ]
        ]);

        if($data){
            $data->op_time = $op_time;
            $data->is_collected = $option;
            $ret = $data->save();
        } else {
            $fm = new CollectModel();
            $fm->uid       = $this->uid;
            $fm->obj_id    = $obj_id;
            $fm->obj_type  = $this->obj_type;
            $fm->op_time   = $op_time;
            $fm->is_collected = $option;
            $ret = $fm->save();
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