<?php

namespace App\Sdks\Validate\Validate\Test;


use App\Sdks\Validate\Validate\BsseValidate;

class ValidateTestIndex extends BsseValidate
{
    public function rules()
    {
        return [
            ['user_name', 'required'],
            ['user_name', 'string'],
            ['user_name', 'size', 'min' => 6, 'max' => 16],
            ['password', 'required'],
            ['password', 'string'],
            ['password', 'size', 'min' => 6, 'max' => 16],
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => '用户名必须',
            'user_name.size'     => '用户名长度不合法',
            'password.required'  => '密码必须',
            'password.size'      => '密码长度不合法',
        ];
    }
}
