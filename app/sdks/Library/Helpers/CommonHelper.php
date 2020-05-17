<?php

namespace App\Sdks\Library\Helpers;

/**
 * 公用函数类库
 */
class CommonHelper
{
    /**
     * 系统启动时间
     *
     * @var int
     */
    public static $SYSTEM_START_TIME;


    /**
     * 系统结束时间
     *
     * @var int
     */
    public static $SYSTEM_END_TIME;

    /**
     * 系统启动时间
     *
     * @return void
     */
    public static function systemStartTime()
    {
        self::$SYSTEM_START_TIME = microtime(true);
    }

    /**
     * 系统结束时间
     *
     * @return void
     */
    public static function systemEndTime()
    {
        self::$SYSTEM_END_TIME = microtime(true);
    }

    /**
     * 解析ini配置文件
     *
     * @param string $file
     * @param bool $sections
     *
     * @return array
     */
    public static function getParseIniData($file, $sections = true)
    {
        $ret = [];
        $data = parse_ini_file($file, $sections);
        foreach ($data as $key => $val) {
            $multi_keys = array_filter(explode(":", $key));
            if (count($multi_keys) == 2) {
                $ret[$multi_keys[0]][$multi_keys[1]] = $val;
            } else {
                $ret[$key] = $val;
            }
        }

        return $ret;
    }

    /**
     * 数组合并
     *
     * @param array $arr1
     * @param array $arr2
     *
     * @return array
     */
    public static function arrayMerge($arr1, $arr2)
    {
        foreach ($arr2 as $key => $val) {
            if (array_key_exists($key, $arr1) && is_array($val)) {
                if (array_keys($val) === range(0, count($val) - 1)) {
                    $arr1[$key] = $arr2[$key];
                } else {
                    $arr1[$key] = self::arrayMerge($arr1[$key], $arr2[$key]);
                }
            } else {
                $arr1[$key] = $val;
            }
        }

        return $arr1;
    }

    /**
     * 生成uuid
     *
     * @return string
     */
    public static function genUuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * 调用类的方法
     *
     * @param string $class
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public static function callMethod($class, $method, $arguments)
    {
        //var_dump($class,$method,$arguments);die();
        $obj = new \ReflectionMethod($class, $method);
        $is_static = $obj->isStatic();
        if ($is_static) {
            return forward_static_call_array([$class, $method], [$arguments]);
        } else {
            if (!is_object($class)) {
                $class = new $class;
            }
            return call_user_func_array([$class, $method], [$arguments]);
        }
    }

    /**
     * 将字符串转换成驼峰命名法
     *
     * @param $str
     *
     * @return string
     */
    public static function transToCamelCase($str)
    {
        $ret = lcfirst(str_replace('_', '', ucwords($str, '_')));

        return $ret;
    }

    /**
     * jsonEncode之前调用
     *
     * @param array $data
     * @param bool $remove
     * @param bool $camel_case
     *
     * @return array
     */
    public static function beforeJsonEncode($data, $remove = false, $camel_case = false)
    {
        $str_null = ['null' => 1, 'Null' => 1, 'NULL' => 1];

        if (is_array($data) && !empty($data)) {
            foreach ($data as $k => $val) {
                $key = $k;
                if ($camel_case) {
                    //将字符串转换成驼峰命名法
                    $key = self::transToCamelCase($k);
                    if ($key != $k) {
                        $data[$key] = $data[$k];
                        unset($data[$k]);
                    }
                }

                if (is_array($val) || is_null($val)) {
                    if (!empty($val)) {
                        $data[$key] = self::beforeJsonEncode($val, $remove, $camel_case);
                        if ($remove && empty($data[$key])) {
                            unset($data[$key]);
                        }
                    } elseif ($remove) {
                        unset($data[$key]);
                    }
                } elseif (is_numeric($val)) {
                    $data[$key] = strval($val);

                } elseif (is_object($val)) {

                } elseif (isset($str_null[$val])) {
                    $data[$key] = "0";
                }
            }
        }

        return $data;
    }

    /**
     * 自定义封装json
     *
     * @param array $data
     * @param bool $filter
     *
     * @return string
     */
    public static function jsonEncode($data, $filter = true)
    {
        if (is_array($data) && $filter === true) {
            $data = self::beforeJsonEncode($data);
        }

        $ret = json_encode($data, JSON_UNESCAPED_UNICODE);

        return $ret;
    }

    /**
     * Wrapper for JSON decode that implements error detection with helpful
     * error messages.
     *
     * @param string $json JSON data to parse
     * @param bool $assoc When true, returned objects will be converted
     *                        into associative arrays.
     * @param int $depth User specified recursion depth.
     *
     * @return mixed
     * @throws \InvalidArgumentException if the JSON cannot be parsed.
     * @link http://www.php.net/manual/en/function.json-decode.php
     */
    public static function jsonDecode($json, $assoc = true, $depth = 512)
    {
        static $jsonErrors = array(
            JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH - Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH - Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR - Unexpected control character found',
            JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX - Syntax error, malformed JSON',
            JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8 - Malformed UTF-8 characters, possibly incorrectly encoded',
        );

        $data = \json_decode($json, $assoc, $depth);

        if (JSON_ERROR_NONE !== json_last_error()) {
            $last = json_last_error();
            $msg = 'Unable to parse JSON data: ' . (isset($jsonErrors[$last]) ? $jsonErrors[$last] : 'Unknown error');

            // todo 跑出异常
            //$err = new SysErr(System::JSON_ERROR, [$msg]);
            //ErrorHandle::throwErr($err);

            $data = $assoc ? [] : null;
        }

        return $data;
    }

    /**
     * 是否json数据
     *
     * @param string $str
     * @return bool
     */
    public static function isJson($str)
    {
        json_decode($str);

        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * 判断是否正式环境
     *
     * @return bool
     */
    public static function isPro()
    {
        $ret = false;

        $config = DiHelper::getConfig();
        $env = $config->application->env;
        if (in_array($env, ['rc', 'pro'])) {
            $ret = true;
        }

        return $ret;
    }

    /**
     * 判断是否在微信浏览器中
     *
     * @return bool
     */
    public static function isWeiXin()
    {
        $agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';

        return strpos($agent, 'micromessenger') ? true : false;
    }

    /**
     * 生成token
     *
     * @param array $origin
     * @param string $key
     *
     * @return string
     */
    public static function encryptToken($origin, $key)
    {
        $crypt = new Crypt();
        $token = $crypt->encryptBase64($origin, $key);

        return $token;
    }

    /**
     * 解开token
     *
     * @param string $token
     * @param string $key
     *
     * @return mixed
     */
    public static function decryptToken($token, $key)
    {
        $res = null;
        try {
            $crypt = new Crypt();
            $res = $crypt->decryptBase64($token, $key);
        } catch (\Exception $e) {
            $res = null;
        }

        return $res;
    }

    /**
     * 获取客户端IP
     *
     * @return string
     */
    public static function getClientIp()
    {
        // 优先使用真实IP
        if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        }

        return $ip;
    }

    /**
     * 允许跨域
     *
     * @return void
     */
    public static function allowOrigin()
    {
        header("Access-Control-Allow-Origin:*");
    }

    /**
     * 获取当前url
     *
     * @return string
     */
    public static function getCurrentUrl()
    {
        $url = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on') {
            $url .= "s";
        }
        $url .= "://";
        if ($_SERVER["SERVER_PORT"] != '80') {
            $url .= $_SERVER["HTTP_HOST"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $url .= $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        }

        return $url;
    }

    /**
     * 数据类型转换
     *
     * @param mixed $var
     * @param string $type
     *
     * @return mixed
     */
    public static function typeConversion($var, $type)
    {
        switch ($type) {
            case "integer":
                $var = intval($var);
                break;
            case 'string':
                $var = strval($var);
                break;
        }

        return $var;
    }

    /**
     * 获取类的所有父类名称,放入数组中
     *
     * @param string $class
     * @return array
     */
    public static function getParentsOfClass($class)
    {
        for ($classes = []; $class = get_parent_class($class); $classes[] = $class) {
            ;
        }

        return $classes;
    }

}