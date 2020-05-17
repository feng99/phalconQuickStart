<?php

namespace App\Sdks\Dao;


use App\Sdks\Models\UserModel;
use phpDocumentor\Reflection\Types\Integer;

/**
 * 用户Dao DB操作类
 */
class UserDao extends UserModel
{

    public static function findFirstById($id)
    {
        return UserDao::findFirst([
            "conditions" => "id = :id:",
            'bind' => [
                "id" => $id
            ]]);
    }

}
