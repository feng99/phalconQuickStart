<?php

namespace App\Sdks\Dao;


use App\Sdks\Models\Oto\OpenCityModel;
use App\Sdks\Models\UserModel;
use phpDocumentor\Reflection\Types\Integer;

/**
 * 用户Dao DB操作类
 */
class UserDao extends UserModel
{

    public static function findFirstById($id)
    {
        return self::findFirst([
            "conditions" => "id = :id:",
            'bind' => [
                "id" => $id
            ]]);
    }

    public static function findList()
    {
        return self::find([
            "conditions" => "id > :id:",
            'bind' => [
                "id" => 0
            ]])->toArray();
    }


    public static function findCustom()
    {
        return self::findAll([
            "conditions" => "id > :id:",
            'bind' => [
                "id" => 0
            ],
            'columns'    => 'id',
            ]);
    }

    public static function findOneData()
    {
        return self::findOne([
            "conditions" => "id > :id:",
            'bind' => [
                "id" => 0
            ],
            'columns'    => 'id',
        ]);
    }


}
