<?php

namespace App\Sdks\Library\Error\Constants;

/**
 * 错误类型
 *
 * 
 */
class ErrType
{
    /**
     * 系统类型错误
     */
    const SYS         = 1;

    /**
     * 核心业务错误
     */
    const CORE_LOGIC  = 2;

    /**
     * 错误类型说明
     *
     * @var array
     */
    public static $ERR_TYPE = [
        self::SYS        => '系统相关错误',
        self::CORE_LOGIC => '核心业务逻辑错误',
    ];

}
