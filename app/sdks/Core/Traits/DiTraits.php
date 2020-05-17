<?php

namespace App\Sdks\Core\Traits;

use Phalcon\Di;

/**
 * DI容器类库
 *
 * 
 */
trait DiTraits
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
    public static function getSharedConfig()
    {
        return self::getShared('config');
    }

}