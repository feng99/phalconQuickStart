<?php

namespace App\Sdks\Library\Constants;

/**
 * 路由配置
 *
 * 
 */
class RouteConfig
{

    public static $SETTINGS = [
        'App\Backend\Controllers\user::register' => [
            'filter'   => [
                'App\Sdks\Core\Logic\Router\Filter\User\Register'
            ],
            'validate' => [
                'App\Sdks\Core\Logic\Router\Validate\User\Register'
            ],
        ],
        'App\Backend\Controllers\user::login' => [
            'filter'   => [
                'App\Sdks\Core\Logic\Router\Filter\User\Login'
            ],
            'validate' => [
                'App\Sdks\Core\Logic\Router\Validate\User\Login'
            ],
        ],
        'App\Backend\Controllers\user::getUserInfo' => [
            'filter'   => [
                'App\Sdks\Core\Logic\Router\Filter\User\GetUserInfo'
            ],
            'validate' => [
                'App\Sdks\Core\Logic\Router\Validate\User\GetUserInfo'
            ],
        ]
    ];
}