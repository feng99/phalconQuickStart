<?php
/**
 * Service基类
 */

namespace App\Sdks\Services\Base;

use App\Sdks\Constants\Base\RedisKey;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Handlers\SysErr;
use App\Sdks\Library\Error\Settings\System;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\LogHelper;
use App\Sdks\Library\Helpers\MemoryLock\LockManager;
use App\Sdks\Library\Helpers\Page;
use Phalcon\Di\Injectable;


class ServiceBase extends Injectable
{

    use Page;
    private static $instances = [];

    /**
     * 获取当前类实例
     *
     * @return ServiceBase
     * @throws \ReflectionException
     */
    public static function getInstance()
    {
        $class = get_called_class();

        if (isset(self::$instances[$class])) {
            return self::$instances[$class];
        }

        if (!method_exists($class, '__construct')) {
            self::$instances[$class] = new $class();
            return self::$instances[$class];
        }

        $params = func_get_args();
        $ref_method = new \ReflectionMethod($class, '__construct');
        $construct_params = $ref_method->getParameters();
        if (!empty($construct_params)) {
            $ref_class = new \ReflectionClass($class);
            self::$instances[$class] = $ref_class->newInstanceArgs($params);
        } else {
            self::$instances[$class] = new $class();
        }

        return self::$instances[$class];
    }

    /**
     * 获取全局共享的DI服务
     *
     * @param $name
     * @return mixed
     */
    protected static function getShared($name)
    {
        return \Phalcon\Di::getDefault()->getShared($name);
    }

    /**
     * 获取配置
     *
     * @return mixed
     */
    protected static function getSharedConfig()
    {
        return \Phalcon\Di::getDefault()->getShared('config');
    }

    /**
     * 获取类常量
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function getClassConstants()
    {
        $reflect = new \ReflectionClass(get_called_class());
        return array_values($reflect->getConstants());
    }
}
