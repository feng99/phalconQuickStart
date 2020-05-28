<?php

namespace App\Backend\Controllers;

use App\Sdks\Core\System\Controllers\PhalBaseController;
use App\Sdks\Core\System\Flash\CustomFlash;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di;
use Phalcon\Http\Request;

/**
 * 控制器基类
 *
 * 
 */
class ControllerBase extends PhalBaseController
{
    public $request;
    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();
    }

    public function initialize()
    {
        $this->request = new Request();
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

    /**
     * 检查请求方式是否为POST
     */
    public static function checkPost(){
        $request = new Request();
        if ($request->isGet()) {
            ErrorHandle::throwErr(Err::create(CoreLogic::REQUEST_METHOD_ERROR));
        }
    }
}
