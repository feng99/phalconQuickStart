<?php
/**
 * "关注"操作服务类
 */

namespace App\Sdks\Services;

use App\Sdks\Constants\Base\RedisKey;
use App\Sdks\Library\Lock\LockManager;
use App\Sdks\Models\FollowModel;


class FollowService extends ServiceOperationBase
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
        return RedisKey::USER_FOLLOW_LOG;
    }

    /**
     * 获取关注的对象数据
     *
     * @param array $params
     * @param int $offset
     * @param int $limit
     * @return array
     */
    protected function getInitData($params, $offset = 0, $limit = 100)
    {
        $res = FollowModel::find([
            'columns' => 'obj_id, op_time',
            'conditions' => "uid = :uid: AND obj_type = :obj_type: AND is_follow = 1",
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
    protected function saveData($params, $option)
    {
        $obj_id  = $params['obj_id'];
        $op_time = $params['op_time'];
        $data = FollowModel::findFirst([
            'conditions' => "uid=:uid: AND obj_id = :obj_id: AND obj_type = :obj_type:",
            'bind'       => [
                'uid' => $this->uid,
                'obj_id' => $obj_id,
                'obj_type' => $this->obj_type
            ]
        ]);
        if($data){
            $data->op_time   = $op_time;
            $data->is_follow = $option;
            $ret = $data->save();
        } else {
            $fm = new FollowModel();
            $fm->uid       = $this->uid;
            $fm->obj_id    = $obj_id;
            $fm->obj_type  = $this->obj_type;
            $fm->op_time   = $op_time;
            $fm->is_follow = $option;
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
        $num = self::getSharedConfig()->logic->profile->user_follow_list_num;
        self::getFansIdsDelCache($obj_id, $this->obj_type,$num + 1,0);

        //self::getFansNumDelCache($obj_id, $this->obj_type);

        //发送关注通知
        if($option == OperationType::DO_IT) {
            //$notice = new NoticeService();
            //$notice->sendNoticeBefore(EventType::FOLLOW,$obj_id,$this->obj_type);
        }
         setRecListCacheFlag($this->uid);

    }

    /**
     * 获取粉丝ID列表
     *
     * @param $obj_id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getFansIds($obj_id, $limit = 10, $offset = 0)
    {
        $account_type = RegisterCoreRotueService::getAccountType();
        if($account_type == AccountSystem::PARENT){
            $obj_type_in = ObjType::USER;
        }else{
            $obj_type_in = join(',',[ObjType::USER_SCHOOL,ObjType::USER_TEACHER]);
        }

        $res = FollowModel::find([
            'conditions' => "obj_id = ?1 AND obj_type in ($obj_type_in) AND is_follow = 1",
            'bind' => [
                1 => $obj_id,
            ],
            'columns' => 'uid,op_time',
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
     * 获取用户粉丝数量从redis
     *
     * @param $obj_id
     * @param $obj_type
     *
     * @return string
     */
    public static function getFansNumFromRedis($obj_id, $obj_type)
    {
        $counter_config = [
            'counter_type' => CounterConfig::USER_FANS_NUM,
            'obj_type'     => $obj_type,
            'obj_id'       => $obj_id,
        ];
        $counter        = new CounterService($counter_config);
        return $counter->getCurrentNum();
    }


    /**
     * 设置计数器类型
     *
     */
    public function setCounterType($type){
        $this->counter_type = $type;
    }


    /**
     * 获取用户粉丝页数据
     *
     * @param $uid
     * @param $page
     * @return array
     */
    public static function getUserFansData($uid,$page = 1)
    {
        return self::detailFollowData($uid,$page,'fans');
    }

    /**
     * 获取用户关注数据
     *
     * @param $uid
     * @param int $page
     * @return array
     */
    public static function getUserFollowData($uid,$page = 1)
    {
        return self::detailFollowData($uid,$page,'follow');
    }









    /**
     * 判断是否关注
     *
     * @param $uid
     * @param $obj_id
     * @return bool
     */
    public static function isFollow($uid, $obj_id)
    {
        $row = FollowModel::findFirst([
            'conditions' => "uid=:uid: AND obj_id = :obj_id: AND is_follow = 1",
            'bind'       => [
                'uid'    => $uid,
                'obj_id' => $obj_id,
            ]
        ]);
        if ($row) {
            return 1;
        }
        return 0;
    }
    
    /**
     * 获取用户关注数据
     *
     * @param  string  $uid
     * @return array
     */
    public static function getFollowUser($uid)
    {
        $fs          = new static($uid, ObjType::USER);
        return array_keys($fs->getAllObjects());
    }
    
    /**
     * 是否操作对象
     *
     * @param  string  $uid
     * @param  string  $obj_id
     * @param  int     $obj_type
     * @return int
     */
    public static function isOperatedRedis($uid, $obj_id, $obj_type = ObjType::USER)
    {
        $class       = new static($uid, $obj_type);
        $is_operated = $class->isOperated($obj_id);
    
        return $is_operated;
    }

    /**
     * 获取关注对象数量
     *
     * @param  string  $uid
     * @param  int     $obj_type
     * @return int
     */
    public static function getObjectsNum($uid, $obj_type = ObjType::USER)
    {
        $class = new static($uid, $obj_type);
        $num   = $class->getAllObjectsNum();

        return $num;
    }

    /**
     * 无须关注的插入集合
     *
     * @param $uid
     *
     * @return boolean
     *
     */
    public static function addUnFollowSet($uid){

        $redis = self::getShared('redis');
        $key = RedisKey::UN_FOLLOW_SET;
        $res = $redis->sAdd($key,$uid);
        $redis->Expire($key,RedisKey::expire($key));
        return $res;

    }


    /**
     * 检查用户是否在集合中
     *
     * @param $uid
     *
     * @return boolean
     *
     */
    public static function isExistUnFollowSet($uid){
        $redis = self::getShared('redis');
        $key = RedisKey::UN_FOLLOW_SET;
        return $redis->sISMEMBER($key,$uid);
    }


    /**
     * 清空集合
     */
    public static function clearUnFollowSet(){
        $redis = self::getShared('redis');
        $key = RedisKey::UN_FOLLOW_SET;
        return $redis->del($key);
    }

    /**
     * 清空我关注的人,动态列表缓存
     * @param $uid
     */
    public static function delFollowFeedCache($uid){
        $cache = self::getShared('redis');
        $key = sprintf(RedisKey::FOLLOW_FEED_LIST,$uid);
        $cache->delete($key);
    }

    /**
     * 推荐阅读列表flag
     * 关注或取消关注时,增加状态
     *
     * @param $uid
     * @param $status
     *
     */
    public static function setRecListCacheFlag($uid,$status=1){
        $cache = self::getShared('cache');
        $key = sprintf(McKey::ARTICLE_FOR_GO_REC_LIST_FLAG,$uid);
        if($status){
            $cache->save($key,$status,McKey::expire(McKey::ARTICLE_FOR_GO_REC_LIST_FLAG));
        }else{
            $cache->delete($key);
        }

    }

}