<?php

/**
 * 系统核心脚本
 */

use Phalcon\Config;
use Phalcon\Mvc\Application;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Core\System\Application\CustomApplication;
/**
 * ----------------------------------------
 * 加载帮助类库
 * ----------------------------------------
 */
require ROOT_PATH . "/app/sdks/Library/Helpers/CommonHelper.php";

/**
 * ----------------------------------------
 * 系统启动计时
 * ----------------------------------------
 */
CommonHelper::systemStartTime();

/**
 * ----------------------------------------
 * 设置错误级别
 * ----------------------------------------
 */
error_reporting(E_ALL);

/**
 * ----------------------------------------
 * 应用配置文件
 * ----------------------------------------
 */
$application_path = '/data/app_config/application.ini';
if (!file_exists($application_path)) {
    exit("application ini file not found in {$application_path}");
}
$app_ini = CommonHelper::getParseIniData($application_path);

/**
 * ----------------------------------------
 * 获取环境变量
 * ----------------------------------------
 */

// 获取配置中的evn环境变量
$env = $app_ini['application']['env'] ?? '';
// 允许的环境配置
$allow_env = [
    'dev',      // 开发环境
    'test',     // 测试环境
    'rc',       // 预发环境
    'pro',      // 生产环境
];

if (!in_array($env, $allow_env, true)) {
    exit('env setting is wrong');
}

/**
 * ----------------------------------------
 * 设置错误显示
 * ----------------------------------------
 */
if (in_array($env, ['rc', 'pro'])) {
    ini_set('display_errors', 'Off');
} else {
    ini_set('display_errors', 'On');
}

/**
 * ----------------------------------------
 * 完善配置
 * ----------------------------------------
 */

// 获取默认环境配置
$config = require ROOT_PATH . "/app/config/default_config.php";

// 获取系统环境配置
$cfg_file = ROOT_PATH . "/app/config/{$env}/config.php";

if (file_exists($cfg_file)) {
    $real_cfg   = require $cfg_file;
    $config     = CommonHelper::arrayMerge($config, $real_cfg);
}
$config = new Config(CommonHelper::arrayMerge($config, $app_ini));
/**
 * ----------------------------------------
 * 常量定义
 * ----------------------------------------
 */
require ROOT_PATH . "/app/config/constants.php";

/**
 * ----------------------------------------
 * 读取自动加载设置
 * ----------------------------------------
 */
require ROOT_PATH . "/app/bootstrap/loader.php";

/**
 * ----------------------------------------
 * 读取服务设置
 * ----------------------------------------
 */
if (php_sapi_name() == 'cli') {
    require ROOT_PATH . "/app/bootstrap/services_cli.php";
} else {
    require ROOT_PATH . "/app/bootstrap/services.php";
}

/**
 * ----------------------------------------
 * 捕获异常
 * ----------------------------------------
 */
require ROOT_PATH . "/app/bootstrap/exception_handler.php";



/**
 * ----------------------------------------
 * 处理请求
 * ----------------------------------------
 */
if (php_sapi_name() != 'cli') {
    $application = new CustomApplication($di);
    $application->run();
}
