<?php
/**
 * 自定义路由配置
 */
return [
    '/' => [
        "controller" => 'index',
        "action"     => 'index',
    ],
    '/:controller/:action/:params' => [
        "controller" => 1,
        "action"     => 2,
        "params"     => 3,
    ],

    '/login' => [
        "controller" => 'index',
        "action"     => 'login',
    ],

    '/logout' => [
        "controller" => 'index',
        "action"     => 'logout',
    ],


    '/upload/:params' => [
        "controller" => 'upload',
        "action"     => 'index',
        'params' => 1
    ],


    '/upload/getVideoConf' => [
        "controller" => 'upload',
        "action"     => 'getVideoConf',
    ],

];
