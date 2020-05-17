<?php

namespace App\Sdks\Models\Mongo;

/**
 * 用户实体
 *
 * 
 */
class UserEntity extends MongoEntity
{
    public $id;
    public $uid;
    public $user_name;
    public $password;
    public $create_time;
    public $is_deleted;

    public function getCollection()
    {
        return $this->mongodb->info_user;
    }

    /**
     * 注册用户
     *
     * @param  array  $data
     * @return bool
     */
    public function register(array $data) : bool
    {
        return $this->save($data);
    }

    /**
     * 根据用户ID获取信息
     *
     * @param  int  $uid
     * @return array
     */
    public function getByUidUserInfo(int $uid) : array
    {
        $filter = [
            'uid'        => $uid,
            'is_deleted' => 0,
        ];

        $options = [
            'projection'=> [
                '_id'       => 0,
                'uid'       => 1,
                'user_name' => 1,
            ],
        ];
        $ret = $this->find($filter, $options);

        return $ret;
    }

    /**
     * 根据用户名获取信息
     *
     * @param  string $user_name
     * @return array
     */
    public function getByNameUserInfo(string $user_name) : array
    {
        $filter = [
            'user_name'  => $user_name,
            'is_deleted' => 0,
        ];

        $options = [
            'projection'=> [
                '_id'       => 0,
                'uid'       => 1,
                'user_name' => 1,
                'password'  => 1,
            ],
        ];
        $ret = $this->find($filter, $options);

        return $ret;
    }

    /**
     * 获取用户信息
     *
     * @param  string $user_name
     * @return bool
     */
    public function checkByNameExist(string $user_name) : bool
    {
        $filter = [
            'user_name'  => $user_name,
            'is_deleted' => 0,
        ];

        $options = [
            'projection'=> [
                '_id' => 1,
            ],
        ];

        $res = false;
        if ($this->find($filter, $options)) {
            $res = true;
        }

        return $res;
    }

}
