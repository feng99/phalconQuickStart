<?php

namespace App\Sdks\Services;


use App\Sdks\Dao\UserDao;
use App\Sdks\Services\Base\ServiceBase;

/**
 * 用户服务类
 */
class UserService extends ServiceBase
{
    public static function getUserInfo($id){
        //return UserDao::findFirstFromCache();
        //return UserDao::getEntityByIdFromCache($id);
        //return UserDao::getEntityByColumn($id);
        return UserDao::findFirst([
            "conditions" => "uid = :uid:",
            'bind'       =>[
                "uid" => $id
            ]
        ]);

    }

}
