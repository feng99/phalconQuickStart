<?php

namespace App\Sdks\Library\Error\Settings;

/**
 * 核心业务逻辑错误配置类
 *
 * 
 */
class CoreLogic
{
    // 错误码范围 2000 ~ 3000

    // 全局配置(2000 ~ 2029)
    const INVALID_PARAM         = 2000;
    const REQUEST_METHOD_ERROR  = 2001;
    const CACHE_ERROR           = 2002;


    // 业务逻辑配置(2030 ~ 2999)
    const USER_NOT_EXIST                    = 2030;
    const USER_REGISTER_ERROR               = 2031;
    const USER_REGISTER_USERNAME_EXIST      = 2032;
    const USER_LOGIN_USERNAME_ERROR         = 2033;
    const USER_LOGIN_PASSWORD_ERROR         = 2034;

    /**
     * 返回给用户的错误信息，包含real_info、show_info、level、is_shown等字段
     *
     * real_info必填，表示错误的真实信息，比较敏感，一般不展示给用户
     * show_info可为空，用于展示给用户的信息。若不填则显示real_info中的信息
     * level可为空，默认为ErrLevel::ERROR,ERROR及以上级别会记录log
     * is_shown可为空，值为true或false，默认为true，表示输出信息给客户端
     *
     * @var array
     */
    public static $MSGS = [
        self::INVALID_PARAM => [
            'real_info' => '参数错误:【%s】',
        ],
        self::REQUEST_METHOD_ERROR => [
            'real_info' => '请求方式错误',
        ],
        self::CACHE_ERROR => [
            'real_info' => '缓存错误',
        ],
        self::USER_NOT_EXIST => [
            'real_info' => '用户不存在',
        ],
        self::USER_REGISTER_ERROR => [
            'real_info' => '用户注册失败',
        ],
        self::USER_REGISTER_USERNAME_EXIST => [
            'real_info' => '用户已注册',
        ],
        self::USER_LOGIN_USERNAME_ERROR => [
            'real_info' => '用户名错误',
            'show_info' => '用户或密码错误',
        ],
        self::USER_LOGIN_PASSWORD_ERROR => [
            'real_info' => '密码错误',
            'show_info' => '用户或密码错误',
        ],
    ];

}
