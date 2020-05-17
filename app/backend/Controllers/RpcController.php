<?php

use App\Backend\Controllers\ControllerBase;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Services\UserService;

/**
 * 测试控制器
 *
 * 
 */
class RpcController //extends ControllerBase
{
    public function testAction($a) 
    {

        $user = \App\Sdks\Models\Entity\Mysql\UserModel::findFirst(["id"=>1]);
        var_dump($user->name);
        //$this->flash->successJson($user);
    }

}
