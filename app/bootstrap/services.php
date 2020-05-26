<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Request;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use App\Sdks\Core\System\Router\CustomRouter;
use App\Sdks\Core\System\Events\DispatchEvents;

$di = new FactoryDefault();

/**
 * 注册路由配置
 */
$di->setShared('router', function () {
    $router = new CustomRouter();

    return $router->runRouter();
});

/**
 * 注册分发器
 */
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager(new DispatchEvents());

    return $dispatcher;
});


/**
 * 注册URL解析器
 */
$di->setShared('url', function () use ($config) {
    $url = new Url();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * 注册模板解析器
 */
$di->setShared('view', function () use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    $view->registerEngines([
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ]);

    return $view;
});

/**
 * 注册request对象
 */
$di->setShared('request', function () use ($config) {
    $request = new Request();
    return $request;
});

/**
 * 公用的DI服务
 */
require ROOT_PATH . "/app/bootstrap/common_di.php";
