<?php

namespace App\Sdks\Library\Helpers;

use App\Sdks\Core\System\Plugins\CustomSecurity;
use Phalcon\Di;
use Pheanstalk\Pheanstalk;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Redis;

/**
 * DI容器类库
 */
class DiHelper
{
    /**
     * 获取全局共享的DI服务
     *
     * @param  string  $name
     * @return object
     */
    public static function getShared($name)
    {
        return Di::getDefault()->getShared($name);
    }

    /**
     * 获取全局配置
     *
     * @return object
     */
    public static function getConfig()
    {
        return self::getShared('config');
    }

    /**
     * 获取共享的Redis连接对象
     *
     * @return Redis
     */
    public static function getRedis(): \Redis
    {
        return self::getShared('redis');
    }


    /**
     * 获取共享的Mysql DB连接对象
     *
     * @return Mysql
     */
    public static function getDB(): Mysql
    {
        return self::getShared('db');
    }


    /**
     * 获取共享的Beanstalk连接对象
     *
     * @return Pheanstalk
     */
    public static function getQueue(): Pheanstalk
    {
        return self::getShared('queue');
    }

    /**
     * 获取共享的security对象
     * 封装了部分安全功能函数
     *
     * @return CustomSecurity
     */
    public static function getSecurity(): CustomSecurity
    {
        return self::getShared('security');
    }



}