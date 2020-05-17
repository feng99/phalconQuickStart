<?php

namespace App\Sdks\Library\Helpers\MemoryLock;

/**
 * 内存锁配置
 */
class LockConfig
{
    /**
     * 适配器配置
     *
     * @var array
     */
    protected static $configAdapter = [
        self::REDIS_ADAPTER => [
            'class' => RedisAdapter::class
        ],
    ];

    /**
     * redis适配器
     *
     * @var string
     */
    const REDIS_ADAPTER    = 'redis';



    /**
     * 配置项
     *
     * @var array
     */
    protected static $config = [
        // 适配器类型
        'adapter'         => self::REDIS_ADAPTER,

        // 内存锁获取时重试等待时间，单位为微秒。默认等待10ms，系统压力比较大，可以适当增大该时间值
        'lockTimewait'    => 10000,

        // 设置重试次数，以保证不会到达PHP超时时间
        'lockRetryTimes'  => 1000,

        // 内存锁过期时间，需要大于PHP脚本默认的超时时间30s
        'lockTimeout'     => 35,

        'lockPrefix'      => '_hm_lock_',
    ];

    /**
     * 初始化
     *
     * @param array  $config
     */
    public static function init(array $config = [])
    {
        LockConfig::setConfig($config);
    }

    /**
     * 设置配置项
     *
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        static::$config = array_merge(static::$config, $config);
    }

    /**
     * 获取配置项
     *
     * @return array
     */
    public static function getConfig(): array
    {
        return static::$config;
    }

    /**
     * 获取适配器配置
     *
     * @return array
     */
    public static function getAdapterConfig(): array
    {
        return static::$configAdapter[static::$config['adapter']] ?? [];
    }
}
