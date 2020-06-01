<?php

namespace App\Sdks\Core\System\Plugins\Dispatcher;

use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;

/**
 * 循环调度前触发插件
 *
 * 
 */
class BeforeDispatchLoop extends Plugin
{
    protected $router;
    protected $request;

    public function __construct()
    {
        $this->router  = DiHelper::getShared('router');
        $this->request = DiHelper::getShared('request');
    }

    /**
     * 循环调度前触发
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @throws \Phalcon\Exception
     */
    public function beforeDispatchLoop(Event $event, Dispatcher $dispatcher)
    {

        // 获取命名空间及控制器等信息
        $default_ns     = 'App\Backend\Controllers';

        $namespace      = $this->router->getNamespaceName() ?: $default_ns;
        $controller     = $this->router->getControllerName();
        $action         = $this->router->getActionName();
        $params         = $this->router->getParams();
        $path           = $controller.'/'.$action;
        $version        = 0;
        if(!empty($params)){
            $version      = $params[0];
            if(mb_stripos($version, 'v') !== false) {
                $path           = $controller.'/'.$action.'/'.$version;
                $this->dispatcher->forward(
                    [
                        'controller' => $controller,
                        'action'     => $action.ucfirst($version),
                    ]
                );
            }
        }

        // 设置数据
        $dispatcher->setParams([
            '_n'     => $namespace,
            '_c'     => $controller,
            '_a'     => $action,
            '_v'     => $version,
            '_path'  => $path
        ]);




    }

}