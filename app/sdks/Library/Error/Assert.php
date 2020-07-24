<?php

namespace App\Sdks\Library\Error;


use App\Sdks\Library\Error\Handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\LogHelper;

/**
 * 自定义断言类
 * Class Assert
 * @author liuaifeng
 * @time  2020/6/22 0022
 * @package App\Sdks\Library\Error
 */
class Assert
{

    /**
     * 数据为空时,抛出异常
     * @param $data
     * @param string $msg
     * @param int $code
     */
    public static function isEmpty($data, string $msg  = "",int $code = CoreLogic::DATA_IS_EMPTY)
    {
        if(empty($data) || null == $data){
            ErrorHandle::throwErr(Err::create($code, [$msg]));
        }
    }

    /**
     * 操作失败,抛出异常
     * @param $res
     * @param $msg
     */
    public static function operateError($res, string $msg)
    {
        if($res == false){
            LogHelper::error("operateError",$msg);
            ErrorHandle::throwErr(Err::create(CoreLogic::OPERATE_ERROR, [$msg]));
        }
    }
}
