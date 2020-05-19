<?php


namespace App\Sdks\Core\System\Plugins\Dispatcher;


use Phalcon\Cli\Dispatcher;

class RpcDispatcherListener
{
    public function beforeDispatchLoop($event, Dispatcher $dispatcher)
    {
        //设置忽略的后缀
        $dispatcher->setTaskSuffix('rpc');
        $dispatcher->setActionSuffix('');
    }
}