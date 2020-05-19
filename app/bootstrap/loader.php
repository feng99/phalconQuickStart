<?php

use Phalcon\Loader;

$loader = new Loader();

// 注册自动加载的目录
$loader->registerDirs(
   [
    $config->application->controllersDir
   ]
);

// 注册命名空间
$loader->registerNamespaces(
   [
      'App'           => ROOT_PATH . '/app',
      'App\Backend'   => ROOT_PATH . '/app/backend',
      'App\Sdks'      => ROOT_PATH . '/app/sdks',
      'App\Tasks'     => ROOT_PATH . '/app/tasks',
      'App\Sdks\Models' => ROOT_PATH . 'app/sdks/Models/',
      'App\Sdks\Library\Helpers\MemoryLock' => ROOT_PATH . '/app/sdks/Library/MemoryLock',
   ]
, true);

$loader->register();

//加载php api监控系统  php-monitor
//require '/data/softdata/php-monitor/src/autoPrepend.php';

// 加载composer
require ROOT_PATH . '/composer/vendor/autoload.php';
