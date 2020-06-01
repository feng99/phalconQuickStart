<?php

namespace App\Sdks\Validate\Filter\Test;



use App\Sdks\Validate\Filter\BaseFilter;

class FilterTestIndex extends BaseFilter
{

    public function rules()
    {
        return [
            ['user_name', 'string|specialChars|trim'],
            ['password', 'string|specialChars|trim'],
        ];
    }
}
