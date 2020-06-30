<?php

namespace App\Sdks\Validate;

use Inhere\Validate\Validation;

/**
 * 路由验证器基类
 *
 *
 * @link https://github.com/inhere/php-validate#built-in-validators
 */
class BaseValidate extends Validation
{
    /**
     * 参数验证
     * @param array $rules
     * @param array $data
     * @return BaseValidate
     */
    public function validations(array $rules,array $data)
    {
        $validation =  static::make($data,$rules);
        //保留参数源格式
        $validation->setPrettifyName(false);
        return  $validation->validate();
    }
}
