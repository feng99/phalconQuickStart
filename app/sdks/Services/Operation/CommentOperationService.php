<?php
/**
 * 评论操作服务类
 */

namespace App\Sdks\Services;

use App\Sdks\Constants\CounterConfig;
use App\Sdks\Constants\EventType;
use App\Sdks\Constants\McKey;
use App\Sdks\Constants\OperationType;
use App\Sdks\Constants\RedisKey;
use App\Sdks\Models\CommentLogModel;


class CommentOperationService extends ServiceOperationBase
{
    /**
     * 构造函数
     *
     * @param string $uid
     * @param int $obj_type
     * @throws \ReflectionException
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
        return RedisKey::USER_COMMENT_LOG;
    }

    /**
     * 获取初始化数据
     *
     * @param array $params
     * @param int $offset
     * @param int $limit
     * @return array
     */
    protected function getInitData($params, $offset = 0, $limit = 100) {
        $res = CommentLogModel::find([
            'columns' => 'obj_id, op_time',
            'conditions' => "uid = :uid: AND obj_type = :obj_type: AND is_commented = 1",
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
        $data = CommentLogModel::findFirst([
            'conditions' => "uid=:uid: AND obj_id = :obj_id: AND obj_type = :obj_type:",
            'bind'       => [
                'uid' => $this->uid,
                'obj_id' => $obj_id,
                'obj_type' => $this->obj_type
            ]
        ]);

        if($data){
            $data->op_time  = $op_time;
            $data->is_commented = $option;
            $ret = $data->save();
        } else {
            $fm = new CommentLogModel();
            $fm->uid       = $this->uid;
            $fm->obj_id    = $obj_id;
            $fm->obj_type  = $this->obj_type;
            $fm->op_time   = $op_time;
            $fm->is_commented = $option;
            $ret = $fm->save();
        }
        return $ret;
    }

    /**
     * 获取对某对象评论过的用户列表
     *
     * @param $obj_id
     * @param $obj_type
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getCommentUids($obj_id, $obj_type, $limit = 10, $offset = 0) {
        $res = CommentLogModel::find([
            'conditions' => 'obj_id = ?1 AND obj_type = ?2 AND is_commented = 1',
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

} 