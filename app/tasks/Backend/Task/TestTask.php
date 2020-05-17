<?php

namespace App\Tasks\Backend;

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
}
