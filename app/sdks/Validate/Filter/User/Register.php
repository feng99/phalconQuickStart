<?php

namespace App\Sdks\Validate\Filter\User;


use App\Sdks\Validate\Filter\BaseFilter;

/**
 * 用户注册过滤器
 *
 * 
 */
class Register extends BaseFilter
{

    public function rules()
    {
        return [
            ['user_name', 'string|specialChars|trim'],
            ['password', 'string|specialChars|trim'],
        ];
    }
}
