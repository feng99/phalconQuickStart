<?php

define('ROOT_PATH', realpath(__DIR__ . "/../.."));

/**
 * 获取模块task
 *
 * @param  string $task
 * @return string
 */
function getModuleTask($task)
{
    $modules = explode('.', $task);
    if (count($modules) == 1) {
        exit("task need at least 2 parameters");
    }

    $class  = ucfirst(array_pop($modules));
    $module = '';
    foreach ($modules as $m) {
        $module .= '\\' . ucfirst($m);
    }
    $module = ltrim($module, "\\");
    $class  = "App\\Tasks\\{$module}\\{$class}";

    return $class;
}

/**
 * 处理console应用参数
 */
$arguments = [];
foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = getModuleTask($arg);
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

// 定义全局的参数， 设定当前任务及动作
define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

/*
 * 判断是否worker多进程
 * DI不使用shared
 */
if (!empty($arguments['params']) && in_array('__worker__', $arguments['params'])) {
    define('SHARED', true);
}

require ROOT_PATH . "/app/bootstrap/bootstrap.php";

// 处理参数
$console->handle($arguments);
