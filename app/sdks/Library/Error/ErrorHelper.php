<?php

namespace App\Sdks\Library\Error;

use App\Sdks\Library\Helpers\CommonHelper;

/**
 * 错误处理帮助类
 *
 * 
 */
class ErrorHelper
{
    /**
     * 获取堆栈信息
     *
     * @param  string  $option
     * @param  int     $limit
     *
     * @return array
     */
    public static function getTrace($option = '', $limit = 0)
    {
        if (defined('DEBUG_BACKTRACE_IGNORE_ARGS') && empty($option)) {
            $option = DEBUG_BACKTRACE_IGNORE_ARGS;
        }
        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            return debug_backtrace($option, $limit);
        } elseif (version_compare(PHP_VERSION, '5.3.6', '>=')) {
            return debug_backtrace($option);
        } else {
            $e = new Exception();
            return $e->getTrace();
        }
    }

    /**
     * 获取出错文件在trace中的偏移量
     *
     * @param  array  $trace
     * @param  string $class
     *
     * @return int
     */
    public static function getTraceOffset($trace, $class)
    {
        $offset = 0;
        if (!empty($trace)) {
            foreach($trace as $k => $t) {
                if ($t['class'] == $class) {
                    $offset = $k + 1;
                    break;
                }
            }
        }

        return $offset;
    }

    /**
     * 获取客户端IP
     *
     * @return string
     */
    public static function getClientIp()
    {
        return CommonHelper::getClientIp();
    }

}
