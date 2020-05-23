<?php
/**
 * 实体服务基类
 * 主要封装
 * //1.根据主键id查询单个对象
 * //2.根据指定字段查询单个对象
 * //3.根据主键id或者自定义字段 进行in查询
 *
 *
 * //封装缓存读取操作  注意:只针对String结构
 * 1.FromCache
 * 2.DelCache
 * 3.ResetCache
 * 5.FromCacheMGet
 * 6.DelCacheBatch
 */

namespace App\Sdks\Dao;

use App\Sdks\Constants\McKey;
use Phalcon\Security\Random;
use App\Sdks\Models\Base\ModelBase;
use App\Sdks\Constants\Base\RedisKey;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\LogHelper;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Services\Base\ServiceBase;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Error\Settings\System;
use App\Sdks\Library\Error\Handlers\SysErr;


class DaoBase extends ModelBase
{


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


    public function __call($name, $arguments)
    {
        self::__callStatic($name, $arguments);
    }

    /**
     * 缓存操作统一封装
     * @param $name
     * @param $arguments
     * @return mixed|void|null
     * @throws \ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        $method = $name;

        if (preg_match(' /(.+?)(FromCache|DelCache|ResetCache|FromCacheMGet)$/', $name, $match)) {
            // 获取真实方法名
            $method = $match[1];
            $action = $match[2];

            $key = sprintf('%s::%s', $class, $method);
            if (isset(RedisKey::$SETTINGS[$key])) {
                $settings = RedisKey::$SETTINGS[$key];
                //如果存在自定义key，则使用自定义key
                if (isset($settings['custom_key'])) {
                    $key = $settings['custom_key'];
                }
            }

            $cacheKey = sprintf("$key||%s", json_encode($arguments));

            switch ($action) {
                case "FromCache":
                    // 从缓存中获取数据
                    return self::wrapGetCache($class, $method, $arguments, $cacheKey, RedisKey::expire($key));
                case "DelCache":
                    // 删除缓存数据
                    return self::wrapDelCache($cacheKey);
                case "ResetCache":
                    // 重置缓存数据
                    return self::wrapGetCache($class, $method, $arguments, $cacheKey, RedisKey::expire($key), true);
                case "FromCacheMGet":
                    // 从缓存中批量获取数据  in查询
                    return self::wrapGetCacheBatch($class, $method, $arguments, $key, RedisKey::expire($key));
                case "DelCacheMGet":
                    // 从缓存中批量删除数据 in查询
                    return self::wrapDelCacheBatch($class, $method, $arguments);
            }
        }

        if (method_exists($class, $method)) {
            return $class::$method($arguments);
        } else {
            trigger_error("Call to undefined method $class::$method()", E_USER_ERROR);
        }
    }


    /**
     * 缓存获取与Reset封装
     * @param $class
     * @param $method
     * @param $arguments
     * @param $cacheKey
     * @param $expire
     * @param bool $reset
     * @return mixed|null
     */
    private static function wrapGetCache($class, $method, $arguments, $cacheKey, $expire, $reset = false)
    {
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
                //过期时间在原定时间,增加0-3分钟的随机时间,防止缓存雪崩问题
                $random = new Random();
                $cache->set($cacheKey, json_encode($res), $expire + $random->number(180));
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
     * @param $cacheKey 缓存的key名称
     * @return mixed
     */
    private static function wrapDelCache($cacheKey)
    {
        return DiHelper::getRedis()->del($cacheKey);
    }


    /**
     * 封装缓存的存取(批量)使用redis存储
     * 注意:
     * 1.原函数  必须支持In查询
     * 2.如果传递的参数不是id  则需要在RedisKey.php中进行配置.
     *
     * @param $class
     * @param $method
     * @param $arguments
     * @param $cacheKey
     * @param $time
     * @return array|bool
     * @throws \ReflectionException
     */
    private static function wrapGetCacheBatch($class, $method, $arguments, $cacheKey, $time)
    {
        if (!is_array($arguments[0])) {
            return false;
        }
        // 获取缓存配置
        $class_origin = $class;
        $class = is_object($class) ? get_class($class) : $class;
        $key = $class . '::' . $method;

        $redis = DiHelper::getRedis();
        $get_keys = [];
        foreach ($arguments[0] as $item) {
            $get_keys[] = sprintf($key . '||%s', CommonHelper::jsonEncode([$item]));
        }
        // 查询缓存
        $res = $redis->mGet($get_keys);

        $get_obj_ids = [];
        if (is_array($res)) {
            foreach ($res as $k => &$rv) {
                if ($rv == false) {
                    $get_obj_ids[] = $arguments[0][$k];
                    unset($res[$k]);
                } elseif (is_string($rv)) {
                    $rv = json_decode($rv, true);
                }
            }
        }
        if ($get_obj_ids) {
            // 查db并写入缓存
            //$db_res = CommonHelper::callMethod($class_origin, $method, [$get_obj_ids]);
            $db_res = CommonHelper::callMethod($class_origin, $method, $get_obj_ids);
            if ($db_res) {
                $set_data = [];
                $db_res = $db_res->toArray();
                $pk_id = 'id';
                //如果没有id字段且配置中未指定字段,则提示错误
                if (!isset($db_res[0]['id']) && !isset(RedisKey::$SETTINGS[$key])) {
                    LogHelper::error('RedisKey.php! no config function ', $key);
                    $err = new SysErr(System::CACHE_KEY_NOT_CONFIGURED);
                    ErrorHandle::throwErr($err);
                } else {
                    //检查是否指定自定义字段
                    $keySetting = RedisKey::$SETTINGS[$key];
                    if (!isset($keySetting['custom_field'])) {
                        LogHelper::error('RedisKey.php! miss custom_field ', $key);
                        $err = new SysErr(System::CACHE_KEY_NOT_CONFIGURED);
                        ErrorHandle::throwErr($err);
                    } else {
                        $pk_id = $keySetting['custom_field'];
                    }
                }
                foreach ($db_res as $item) {
                    //$set_data[sprintf($cacheKey . '||%s', CommonHelper::jsonEncode([$item[$pk_id]]))] = json_encode($item, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                    $set_data[sprintf($cacheKey . '||%s', $item[$pk_id])] = json_encode($item, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                }
                $redis->mSet($set_data);

                //过期时间在原定时间,增加0-3分钟的随机时间,防止缓存雪崩问题
                $random = new Random();
                foreach ($set_data as $fk => $fv) {
                    $redis->expire($fk, $time + $random->number(180));
                }
                $res = array_merge($db_res, $res);
                //按照id重新按顺序组合
                $res_sort = array_combine(array_column($res, $pk_id), $res);

                $res = [];
                foreach ($arguments[0] as $item) {
                    if (!empty($res_sort[$item])) {
                        $res[] = $res_sort[$item];
                    }
                }
            }
        }
        return $res;
    }


    /**
     * 封装删除缓存-批量
     *
     * @param $class
     * @param $method
     * @param $arguments
     * @return mixed
     */
    private static function wrapDelCacheBatch($class, $method, $arguments)
    {
        // 获取缓存key
        $class = is_object($class) ? get_class($class) : $class;
        $key = $class . '::' . $method;

        //如果存在自定义key，则使用自定义key
        if (isset(RedisKey::$SETTINGS[$key]['custom_key'])) {
            $key = RedisKey::$SETTINGS[$key]['custom_key'];
        }

        $redis = DiHelper::getRedis();
        $res = false;
        foreach ($arguments[0] as $item) {
            $cache_key = sprintf($key . '||%s', CommonHelper::jsonEncode([$item]));
            $res = $redis->del($cache_key);
            LogHelper::debug('del_entity_key', $cache_key);
        }
        return $res;
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