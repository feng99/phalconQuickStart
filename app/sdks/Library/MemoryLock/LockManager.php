<?php

namespace App\Sdks\Library\Helpers\MemoryLock;


/**
 * 内存锁管理
 *
 * 使用示例:
 * $redis = DiHelper::getSharedRedis();
 * LockManager::init($redis);
 * //获取锁
 * LockManager::lock($key);
 * //释放锁
 * LockManager::unlock($key);
 */
class LockManager
{
    /**
     * 适配器
     *
     * @var null
     */
    protected static $adapter = null;

    /**
     * 初始化配置
     *
     * @param object $client
     * @param array $config
     */
    public static function init($client, array $config = [])
    {
        LockConfig::init($config);
        static::$adapter = new RedisAdapter($client);
    }


    /**
     * 获取内存锁
     *
     * @param  string $lock_key
     * @return mixed
     */
    public static function lock(string $lock_key)
    {
        return static::$adapter->lock($lock_key);
    }

    /**
     * 释放内存锁
     *
     * @param  string $lock_key
     * @return mixed
     */
    public static function unlock(string $lock_key)
    {
        return static::$adapter->unlock($lock_key);
    }
}
