<?php

namespace App\Sdks\Library\Error\Constants;

/**
 * 错误级别常量
 *
 *    0       Emergency: system is unusable
 *    1       Alert: action must be taken immediately
 *    2       Critical: critical conditions
 *    3       Error: error conditions
 *    4       Warning: warning conditions
 *    5       Notice: normal but significant condition
 *    6       Informational: informational messages
 *    7       Debug: debug-level messages
 *
 * 根据实际需求精简
 *
 * @link   http://tools.ietf.org/html/rfc5424
 * 
 */
class ErrLevel
{
    const ALERT     = 1;
    const ERROR     = 3;
    const WARNING   = 4;
    const DEBUG     = 7;
}
