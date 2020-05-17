<?php

use Phalcon\DI\FactoryDefault\CLI as CliDI;
use Phalcon\CLI\Console as ConsoleApp;
use Phalcon\Mvc\View;

//使用CLI工厂类作为默认的服务容器
$di = new CliDI();

// 创建console应用
$console = new ConsoleApp();
$console->setDI($di);

$di->setShared('console', $console);

// 公用的DI服务
require ROOT_PATH . "/app/bootstrap/common_di.php";
