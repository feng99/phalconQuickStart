<?php

namespace App\Sdks\Services;


use App\Sdks\Dao\UserDao;
use App\Sdks\Models\UserModel;
use App\Sdks\Services\Base\ServiceBase;

/**
 * 用户服务类
 */
class UserService extends ServiceBase
{
    public static function getUserInfo($id){
        //return UserDao::findFirstById($id)->toArray();
        return UserDao::findFirstById($id);
    }

    public static function getEntityById($id){
        return UserDao::getEntityById(5);
    }

    public static function getUserList($id){
        return UserDao::findList();
    }

}
