<?php

namespace App\Sdks\Validate;


use App\Sdks\Validate\Filter\Test\FilterTestIndex;
use App\Sdks\Validate\Filter\Upload\FilterUploadImg;
use App\Sdks\Validate\Validate\Test\ValidateTestIndex;
use App\Sdks\Validate\Validate\Upload\ValidateUploadImg;

/**
 * 参数过滤与参数验证的路由配置
 */
class ValidateRouteConfig
{


    public static $SETTINGS = [
        'test/index/v1' => [
            'filter' => FilterTestIndex::class,
            'validate' => ValidateTestIndex::class
        ],
        'upload/img' => [
            'filter' => FilterUploadImg::class,
            'validate' => ValidateUploadImg::class
        ],


    ];
}