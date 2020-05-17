<?php

use App\Backend\Controllers\ControllerBase;

/**
 * 错误控制器
 *
 * 
 */
class ErrorController extends ControllerBase
{
    public function err404Action()
    {
        echo "err404";die;
    }

}
