<?php

namespace App\Backend\Controllers;

use App\Sdks\Core\System\Controllers\PhalBaseController;
use App\Sdks\Core\System\Flash\CustomFlash;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\LogHelper;
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
    public $loginUuid;
    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();
    }

    public function getRequest() : Request
    {
        if($this->request == null) {
            $this->request = new Request();
        }
        return $this->request;
    }

    public function initialize()
    {
        // 允许跨域
        header("Access-Control-Allow-Origin:*");


        $this->request = $this->getRequest();
        parent::initialize();

        $this->loginUuid = intval($this->request->getHeader("Userid"));

        $params  = $this->request->get();
        unset($params['_url']);
        unset($params['PHPSESSID']);
        //打印请求地址和参数 方便调试
        LogHelper::debug("TradeServer:request_params",$params);
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
