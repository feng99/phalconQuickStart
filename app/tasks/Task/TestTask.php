<?php

namespace App\Tasks\Task;



use App\Sdks\Services\UserService;
use App\Tasks\Base\BaseTask;

/**
 * 测试task
 *
 */
class TestTask extends BaseTask
{
    public function indexAction()
    {
        echo __CLASS__;
    }


    public function testAction()
    {
        $userInfo = UserService::getUserInfo(2);
        var_dump($userInfo->toArray());
    }


}
