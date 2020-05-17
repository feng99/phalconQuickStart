<?php

namespace App\Sdks\Library\Error;

use App\Sdks\Library\Error\handlers\Err;

/**
 * 错误处理类
 *
 * 
 */
class ErrorHandle
{
    /**
     * 抛出错误进行相应的处理
     *
     * @param  Err    $err
     * @param  array  $ret_data
     */
    public static function throwErr(Err $err, $ret_data = [])
    {
        $err->setRetData($ret_data);
        $err->handle();
    }

}
