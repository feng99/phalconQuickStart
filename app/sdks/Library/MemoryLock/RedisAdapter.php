<?php

namespace App\Sdks\Library\Helpers\MemoryLock;


/**
 * redis内存锁适配器
 */
class RedisAdapter
{
    /**
     * 客户端对象
     *
     * @var Object
     */
    private $redis = null;

    /**
     * 构造函数
     *
     * @param object $redis
     */
    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    /**
     * 获取内存锁key
     *
     * @param  string $lockKey
     * @return string
     */
    protected function getLockKey(string $lockKey)
    {
        return LockConfig::getConfig()['lockPrefix'] . $lockKey;
    }

    /**
     * 获取内存锁
     *
     * @param  string $lockKey
     * @return mixed
     */
    public function lock(string $lockKey)
    {
        $lockConfig = LockConfig::getConfig();
        $lockKey    = $this->getLockKey($lockKey);

        $i = 0;
        do {
            $isLock = $this->redis->setnx($lockKey, 1);

            if ($isLock == true) {
                $this->redis->expire($lockKey, $lockConfig['lockTimeout']);
            } else {
                if ($this->redis->ttl($lockKey) == -1) {
                    $this->redis->expire($lockKey, 5);
                }
            }

            // 如果第一次没有获取到锁则等待指定时间后重试
            if ($i > 0) {
                usleep($lockConfig['lockTimewait']);
            }

            $i++;

            // 超过重试次数后退出
            if ($i > $lockConfig['lockRetryTimes']) {
                throw new RedisLockException('memory locking failure');
            }
        } while(!$isLock);

        return $isLock;
    }

    /**
     * 释放内存锁
     *
     * @param  string $lock_key
     * @return bool
     */
    public function unlock(string  $lock_key)
    {
        $lock_key = $this->getLockKey($lock_key);

        return $this->redis->delete($lock_key);
    }
}
