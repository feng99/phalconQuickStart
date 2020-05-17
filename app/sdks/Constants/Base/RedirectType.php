<?php
/**
 * 跳转类型
 */

namespace App\Sdks\Constants\Base;


class RedirectType
{
    /**
     * 不跳转
     */
    const VOID          = 0;
    /**
     * 跳转到APP内部
     */
    const APP           = 1;
    /**
     * 跳转到web页面
     */
    const WEB           = 2;


    /**
     * 配置
     *
     * @var array
     */
    public static $SETTINGS = [

        self::VOID => [
            'id'   => self::VOID,
            'name' => "无跳转"
        ],
        self::APP => [
            'id'   => self::APP,
            'name' => 'APP内部跳转'
        ],
        self::WEB => [
            'id'   => self::WEB,
            'name' => '指定链接跳转',
        ],

    ];


}
