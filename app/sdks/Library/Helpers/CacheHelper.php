<?php

namespace App\Sdks\Library\Helpers;

use App\Sdks\Core\Traits\CacheTraits;
use App\Sdks\Library\Constants\CacheConfig;

/**
 * 缓存帮助类库
 */
class CacheHelper
{
    use CacheTraits;

    /**
     * 获取过期时间
     *
     * @param  string $key
     * @return int
     */
    public static function expire($key)
    {
        $time = CacheConfig::DEFAULT_EXPIRE_TIME;
        if ($key && isset(CacheConfig::$SETTINGS[$key]['expire_time'])) {
            $time = CacheConfig::$SETTINGS[$key]['expire_time'];
        }

        return $time;
    }

}