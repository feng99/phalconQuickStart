<?php

namespace App\Sdks\Library\Error\Handlers;

use App\Sdks\Library\Error\Settings\CoreLogic;

/**
 * 核心业务逻辑相关错误类
 *
 * 
 */
class CoreLogicErr extends Err implements ErrInterface
{
    /**
     * 构造函数
     *
     * @param int  $code
     * @param null $custom_info
     */
    public function __construct($code, $custom_info = null)
    {
        parent::__construct($code, $custom_info);

        $this->msgs = CoreLogic::$MSGS;
    }

    /**
     * 处理错误
     */
    public function handle()
    {
        $this->handleError();
    }

}
