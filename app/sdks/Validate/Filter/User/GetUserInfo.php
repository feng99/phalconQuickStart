<?php

namespace App\Sdks\Validate\Filter\User;


use App\Sdks\Validate\Filter\BaseFilter;

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