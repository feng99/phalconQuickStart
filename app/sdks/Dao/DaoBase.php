<?php
/**
 * 实体服务基类
 * 主要封装
 * 1.根据主键id查询单个对象
 * 2.根据指定字段查询单个对象
 * 3.根据主键id或者自定义字段 进行in查询
 */

namespace App\Sdks\Dao;

use App\Sdks\Constants\Base\RedisKey;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\LogHelper;
use App\Sdks\Library\Helpers\Page;
use App\Sdks\Models;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Constants\Base\EntityConfig;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\System;
use App\Sdks\Services\Base\ServiceBase;


class DaoBase extends Models\Base\ModelBase
{










    public function __call($name, $arguments)
    {
        self::__callStatic($name,$arguments);
    }

    /**
     * 缓存操作统一封装
     * From  从缓存中获取数据
     * Del   删除指定的缓存
     * Reset 缓存重新赋值
     * @param $name
     * @param $arguments
     * @return mixed|void|null
     */
    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        $method = $name;

        if (preg_match(' /(.+?)(From|Del|Reset)Cache$/', $name, $match)) {
            // 获取真实方法名
            $method = $match[1];
            $action = $match[2];

            $key = sprintf('%s::%s', $class, $method);
            $settings = RedisKey::$SETTINGS[$key];
            //如果存在自定义key，则使用自定义key
            if (isset($settings['custom_key'])) {
                $key = $settings['custom_key'];
            }
            $cacheKey = sprintf("$key||%s", json_encode($arguments));

            switch ($action) {
                case "From":
                    return self::wrapGetCache($class, $method, $arguments, $cacheKey, RedisKey::expire($key));
                case "Del":
                    return self::wrapDelCache($cacheKey);
                case "Reset":
                    return self::wrapGetCache($class, $method, $arguments, $cacheKey, RedisKey::expire($key), true);
            }
        }

        if (method_exists($class, $method)) {
            return $class::$method($arguments);
        } else {
            trigger_error("Call to undefined method $class::$method()", E_USER_ERROR);
        }
    }


    private static function wrapGetCache($class, $method, $arguments, $cacheKey, $expire, $reset=false)
    {
        //查询缓存
        $cache = DiHelper::getRedis();
        $t = microtime(true);
        if ($reset || !$cache->exists($cacheKey)) {
            //if ($lock = LockManager::lock($cacheKey)) {
            do {
                if ($res = json_decode($cache->get($cacheKey), true)) {
                    if ($res['t'] > $t) break;
                }
                $data = forward_static_call_array([$class, $method], $arguments);
                $res = [
                    't' => microtime(true),
                    'r' => $data,
                ];
                $cache->set($cacheKey, json_encode($res), $expire);
            } while (0);

            //LockManager::unlock($lock);
            return $res['r'];
            //}
        }
        $res = json_decode($cache->get($cacheKey), true);
        return isset($res['r']) ? $res['r'] : null;
    }


    /**
     * 删除缓存
     * @param String $cacheKey
     * @return mixed
     */
    private static function wrapDelCache(String $cacheKey)
    {
        return DiHelper::getRedis()->del($cacheKey);
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