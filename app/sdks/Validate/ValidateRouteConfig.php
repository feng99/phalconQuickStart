<?php

namespace App\Sdks\Validate;


/**
 * 参数过滤与参数验证的路由配置
 */
class ValidateRouteConfig
{


    public static $SETTINGS = [
        //样例  单个校验规则
        'room/open/v1' => [
            //'validate' => ['mediaType,roomType,name','required','msg' => '{attr} 必须!']
            'validate' => ['mediaType,roomType,name', 'required', 'msg' => '必须传递']
        ],
        //样例  多个校验规则
        'room/userJoin/v1' => [
            'validate' => [
                ['roomId', 'required', 'msg' => '必须传递'],
                ['roomId', 'number', 'msg' => '必须>0']
            ]
        ],


    ];
}