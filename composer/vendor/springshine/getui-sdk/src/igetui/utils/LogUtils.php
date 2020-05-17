<?php

namespace GeTui\Notification\Igetui\Utils;

class LogUtils
{
    static $debug = false;
    public static function debug($log)
    {
        if (LogUtils::$debug)
            echo date('y-m-d h:i:s',time()).($log) . "\r\n";
    }
}