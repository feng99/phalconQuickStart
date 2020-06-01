<?php

namespace App\Sdks\Validate\Validate\Upload;


use App\Sdks\Validate\Validate\BsseValidate;

class ValidateUploadImg extends BsseValidate
{
    public function rules()
    {
        return [
            ['fileTag', 'required'],
            ['fileTag', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'fileTag.required'  => 'fileTag字段必须',
            'fileTag.string'    => 'fileTag必须为字符串',
        ];
    }
}
