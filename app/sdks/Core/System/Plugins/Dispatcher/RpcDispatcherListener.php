<?php


namespace App\Sdks\Core\System\Plugins\Dispatcher;


use Phalcon\Cli\Dispatcher;

class RpcDispatcherListener
{
    public function beforeDispatchLoop($event, Dispatcher $dispatcher)
    {
        $dispatcher->setTaskSuffix('rpc');
        $dispatcher->setActionSuffix('');
    }
}