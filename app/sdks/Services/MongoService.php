<?php

namespace App\Sdks\Services;

use App\Sdks\Models\Logic\UserLogic;

/**
 * mongo服务
 *
 * 
 */
class MongoService extends BaseService
{
    /**
     * 获取UserLogic类
     *
     * @return UserLogic
     */
    protected static function getUserLogic()
    {
        return new UserLogic();
    }


    /**
     * 添加数据
     *
     * @param  array $data
     * @return array
     */
    public static function add(array $data) : array
    {
        return static::getUserLogic()->add($data);
    }

    /**
     * 用户登录
     *
     * @param  array  $data
     * @return array
     */
    public static function login(array $data) : array
    {
        return static::getUserLogic()->login($data);
    }

    /**
     * 获取用户信息
     *
     * @param  int  $uid
     * @return array
     */
    public static function getUserInfo(int $uid) : array
    {
        return static::getUserLogic()->getUserInfo($uid);
    }

}
