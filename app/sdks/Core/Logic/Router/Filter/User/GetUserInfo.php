<?php

namespace App\Sdks\Core\Logic\Router\Filter\User;

use App\Sdks\Core\Logic\Router\Filter\BaseFilter;

/**
 * 用户信息过滤器
 *
 * 
 */
class GetUserInfo extends BaseFilter
{

    public function rules()
    {
        return [
            ['uid', 'int|trim'],
        ];
    }
}