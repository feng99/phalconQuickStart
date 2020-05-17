<?php

namespace App\Sdks\Library\Error\Settings;

/**
 * 系统错误配置类
 *
 * 
 */
class System
{
    // 错误码范围 1000~1999

    const MEMCACHE_KEY_NOT_CONFIGURED       = 1001;
    const CRYPT_DECODE_ERROR                = 1002;
    const JSON_ERROR                        = 1003;
    const LOCK_ACQUIRE_ERROR                = 1004;
    const LOCK_RELEASE_ERROR                = 1005;
    const ENTITY_NOT_CONFIGURED             = 1006;
    const OBJ_TYPE_NOT_CONFIGURED            = 1007;
    const REDIS_KEY_NOT_CONFIGURED          = 1008;
    const INTERNAL_REQUEST_ERROR            = 1009;
    const CLASS_NOT_EXISTS                  = 1010;
    const FUNCTION_NOT_EXISTS               = 1011;

    /**
     * 返回给用户的错误信息，包含real_info、show_info、level、is_shown等字段
     *
     * real_info必填，表示错误的真实信息，比较敏感，一般不展示给用户
     * show_info可为空，用于展示给用户的信息。若不填则显示real_info中的信息
     * level可为空，默认为ErrLevel::ERROR。ERROR及以上级别会记录log
     * is_shown可为空，值为true或false，默认为true，表示抛出异常给客户端
     *
     * @var array
     */
    public static $MSGS = [
        self::MEMCACHE_KEY_NOT_CONFIGURED => [
            'real_info' => 'cache_key没有配置',
            'show_info' => 'cache_key没有配置'
        ],
        self::CRYPT_DECODE_ERROR => [
            'real_info' => 'crypt解密失败',
            'is_shown'  => false,
        ],
        self::JSON_ERROR => [
            'real_info' => 'json解析出错：%s',
            'is_shown'  => false,
        ],
        self::LOCK_ACQUIRE_ERROR => [
            'real_info' => '加锁失败',
            'show_info' => '加锁失败',
        ],
        self::LOCK_RELEASE_ERROR => [
            'real_info' => '释放锁失败',
            'show_info' => '释放锁失败',
        ],
        self::ENTITY_NOT_CONFIGURED => [
            'real_info' => '该实体没有配置',
            'show_info' => '方法调用失败'
        ],
        self::OBJ_TYPE_NOT_CONFIGURED => [
            'real_info' => '该对象类型没有配置: %d',
            'show_info' => '操作失败'
        ],
        self::REDIS_KEY_NOT_CONFIGURED => [
            'real_info' => 'Redis Key没有配置',
            'show_info' => '操作失败'
        ],
        self::INTERNAL_REQUEST_ERROR => [
            'real_info' => '网络请求错误',
        ],
        self::CLASS_NOT_EXISTS => [
            'real_info' => 'class不存在：%s',
            'show_info' => '操作失败'
        ],
        self::FUNCTION_NOT_EXISTS => [
            'real_info' => 'function不存在：%s',
            'show_info' => '操作失败'
        ],

    ];
    
}
