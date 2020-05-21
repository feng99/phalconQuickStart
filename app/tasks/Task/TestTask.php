<?php

namespace App\Tasks\Task;



use App\Tasks\Base\BaseTask;

/**
 * 测试task
 *
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
        echo "test";
    }


}
