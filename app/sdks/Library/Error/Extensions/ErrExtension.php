<?php

namespace App\Sdks\Library\Error\Extensions;

/**
 * 用户扩展类(根据每个用户自己的环境实现)
 *
 * 
 */
class ErrExtension
{
    /**
     * 获取log的存放路径
     * 
     * @return string
     */
    public static function getLogPath()
    {
        $config = Di::getDefault()->getShared('config');
        $log_path = $config->application->error_log_path;

        return $log_path;
    }

}
