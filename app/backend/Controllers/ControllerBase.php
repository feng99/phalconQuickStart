<?php

namespace App\Backend\Controllers;

use App\Sdks\Core\System\Controllers\PhalBaseController;
use App\Sdks\Core\System\Flash\CustomFlash;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di;

/**
 * 控制器基类
 *
 * 
 */
class ControllerBase extends PhalBaseController
{
    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();
    }

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 获取共享的自定义闪存类
     *
     * @return CustomFlash
     */
    public static function getFlash(): CustomFlash
    {
        return Di::getDefault()->getShared("flash");
    }
}
