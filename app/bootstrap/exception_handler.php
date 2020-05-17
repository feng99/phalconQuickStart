<?php

/**
 * 系统异常处理
 */

use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Mvc\Dispatcher\Exception;
use App\Sdks\Library\Helpers\CommonHelper;

set_exception_handler(function($e) {
    $class = get_class($e);
    if (strpos($class, '\\') !== false) {
        $arr   = explode('\\', $class);
        $class = end($arr);
    }

    switch ($class) {
        case 'HtmlFmtException':
            DiHelper::getShared('flash')->error($e->getMessage());
            break;
        case 'JsonFmtException':
            DiHelper::getShared('flash')->errorJson($e->getData(), $e->getCode(), $e->getMessage());
            break;
        case 'JsonpFmtException':
            $info = [
                'ret'  => $e->getCode(),
                'msg'  => $e->getMessage(),
                'data' => $e->getData(),
            ];
            echo $e->getCallback() .'('. CommonHelper::jsonEncode($info, true) . ')';
            break;
        default:
            $err_code = !$e->getCode() ? 500 : $e->getCode();

            // 详细错误信息
            $msg  = "\nError Code: {$err_code}";
            $msg .= "\n" . $e->getMessage() . "\n";
            $msg .= $e->getTraceAsString()."\n";
            if (php_sapi_name() == 'cli') {
                $msg .= var_export($_SERVER, true)."\n";
            } else {
                $msg .= var_export($_REQUEST, true)."\n";
            }

            // 404的情况
            if ($e instanceof Exception) {
                $show_msg = '404 NOT FOUND';
            } else {
                /*if (DiHelper::getSharedConfig()->application->env != 'dev') {
                    $show_msg = '系统开小差了,请稍等片刻';
                } else {
                    $show_msg = $msg;
                }*/
                $show_msg = $msg;
            }
            // 输出错误信息
            DiHelper::getShared('flash')->errorJson([], -1, $show_msg);
            break;
    }
});
