<?php

namespace App\Sdks\Validate\Filter\Upload;



use App\Sdks\Validate\Filter\BaseFilter;

class FilterUploadImg extends BaseFilter
{

    public function rules()
    {
        return [
            ['fileTag', 'string|specialChars|trim'],
        ];
    }
}
