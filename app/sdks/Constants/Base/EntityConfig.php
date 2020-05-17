<?php
/**
 * 实体配置类
 */

namespace App\Sdks\Constants\Base;


class EntityConfig
{
    /**
     * dao类的名称,不是model类的
     */
    const USER        = 'user';


    /**
     * 配置service对应的model
     * model 配置model类的名字
     * field 配置findFirst()函数传递的条件字段
     *       一次只查询一条数据   可以配置主键,或者任意字段
     * custom 不允许配置为主键.
     * @var array
     */
    public static $SETTINGS = [

        self::USER        => [
            'model'             => 'UserModel',
            'dao'             => 'UserDao',
            'default_column'  => 'id',
            'custom_column'   => 'uid',
        ],

    ];

}
