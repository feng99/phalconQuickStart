<?php

use App\Sdks\Core\System\Plugins\Dispatcher\RpcDispatcherListener;
use Phalcon\Cli\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

//define('ROOT_PATH', realpath(__DIR__ . "/../../.."));
define('ROOT_PATH', realpath(__DIR__ . "/../.."));
define('GATEWAY', ucfirst(basename(__DIR__)));

require ROOT_PATH . "/app/bootstrap/bootstrap.php";

$di->set('dispatcher', function () {

    $eventsManager = new EventsManager();
    $eventsManager->attach("dispatch", new RpcDispatcherListener());

    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

$rpc_class = "App\Rpc\Api";

list($host,$port) = explode(":",$config->rpc_server->bind);

$server = new Swoole\Server($host,$port,SWOOLE_BASE,SWOOLE_SOCK_TCP);

$server->set($config->rpc_server->settings->toArray());

$server->on('receive',  function($svr, $fd, $from_id, $data) use($console,$rpc_class){

    $params = [
        'server'  => $svr,
        'fd'      => $fd,
        'from_id' => $from_id,
        'data'    => $data
    ];

    $console->handle(['task' => $rpc_class,'params'=>$params]);

});

echo "handle: {$rpc_class}\n";

$server->start();


