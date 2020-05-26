<?php

use App\Backend\Controllers\ControllerBase;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\Exceptions\CustomException;

class JwttestController extends ControllerBase
{

    /**
     * @throws JsonFmtException
     */
    public function indexAction()
    {
        try {
            //$user = UserModel::findFirst(["id"=>1]);
            //$this->getFlash()->successJson("test ok");
            var_dump("888");
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }



}
