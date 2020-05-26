<?php

use App\Backend\Controllers\ControllerBase;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\LogHelper;
use App\Sdks\Services\UserService;
use Phalcon\Mvc\Controller;

/**
 * 默认控制器
 *
 * 
 */
class IndexController extends ControllerBase
{
    /**
     * @throws JsonFmtException
     */
    public function indexAction()
    {
        /*
         * 控制器层(Controller) 调用服务层
         * 服务层(Service)      数据操作层(可调用多个Dao)
         * 数据操作层(Dao)      调用实体层 封装操作DB的函数
         * 实体层(Model)        无调用,DB TABLE的映射
         */
        try {
            $post        = $this->request->getPost();
            var_dump($post);die();
            LogHelper::debug("testlog","logmsg");
            $this->getFlash()->successJson('hello world==!');
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

}
