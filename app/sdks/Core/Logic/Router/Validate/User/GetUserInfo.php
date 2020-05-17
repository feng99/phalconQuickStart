<?php

namespace App\Sdks\Core\Logic\Router\Validate\User;

use App\Sdks\Core\Logic\Router\Validate\BsseValidate;

/**
 * 用户信息验证器
 *
 * 
 */
class GetUserInfo extends BsseValidate
{
    public function rules()
    {
        return [
            ['uid', 'required'],
            ['uid', 'number'],
        ];
    }

    public function messages()
    {
        return [
            'uid.required' => '用户ID必须',
            'uid.number'   => '用户ID不合法',
        ];
    }
}
