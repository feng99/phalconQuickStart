<?php

namespace App\Sdks\Library\Helpers;

use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Handlers\CoreLogicErr;
use App\Sdks\Library\Error\Settings\CoreLogic;
use GuzzleHttp\Client;
use Phalcon\Crypt;

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
    public static function arrayMerge($arr1, $arr2): array
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
     * 自动判断是否静态方法
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
        return $crypt->encryptBase64($origin, $key);
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
    public static function getClientIp(): string
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
                $var = (int)$var;
                break;
            case 'string':
                $var = (string)$var;
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

    /**
     * 使用Guzele扩展,模拟发送http请求
     * 支持get,post方式
     * @param string $url 请求的http地址
     * @param array $params 请求参数
     * @param string $method 请求方式 默认为POST
     * @param int $timeout 超时时间 默认为3秒
     * @param array $headers 头信息
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author liuaifeng@szy.cn
     */
    public static function httpRequestGuzzle($url = '',$params = [],$method = 'POST',$timeout = 5,$headers = []){
        $res = [];
        try{
            if(empty($headers)){
                $headers = ['Content-Type'=>'application/json'];
            }
            $client   = new Client();
            $response = $client->request($method,$url,
                [
                    'headers' => $headers,
                    'json'    => $params,
                    'timeout' => $timeout,
                ]
            );
            $http_status_code     = $response->getStatusCode();
            if(!in_array($http_status_code,[200,301,302],false)){
                $err = new CoreLogicErr(CoreLogic::PREVIOUS_SERVICE_ERROR, ['']);
                ErrorHandle::throwErr($err);
            }

            $res = self::jsonDecode($response->getBody(), true);
        }catch (\Exception $e){
            $response = '';
            $request  = \GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {

                $response = \GuzzleHttp\Psr7\str($e->getResponse());
            }
            //记录详细错误信息
            LogHelper::error('http_request_guzzle_error', [$e,$request,$response,]
            );
        }
        return $res;
    }


    /**
     * 过滤文本中的特殊字符
     * @param string $txt
     * @param boolean $clear_number
     * @return mixed|string
     * @author liuaifeng@szy.cn
     */
    public static function clearTxt($txt = '',$clear_number = true)
    {
        //$txt = "女儿五岁了，上幼儿园了，我白天空闲时多了，在家帶娃也可用手<ud83d><udc23>睁米，挺简单的，1️⃣5️⃣种耳只卫供选择，做两年了，月月上几仟哒，✝️V信 47189 2917先看是什么（此处不回复）也能帮宝爸减轻点负担，我是宝妈，诚信做人。";

        //过掉html标签
        $t = strip_tags($txt);
        $number = '';
        if($clear_number){
            $number = "01234567899⃣";
        }
        //过滤掉以下内容
        $char = "️ .$number.5️⃣V✝ ，。、！？：；﹑•＂…‘’“”〝〞∕¦‖—　〈〉﹞﹝「」‹›〖〗】【»«』『〕〔》《﹐¸﹕︰﹔！¡？¿﹖﹌﹏﹋＇´ˊˋ―﹫︳︴¯＿￣﹢﹦﹤‐­˜﹟﹩﹠﹪﹡﹨﹍﹉﹎﹊ˇ︵︶︷︸︹︿﹀︺︽︾ˉ﹁﹂﹃﹄︻︼（）";


        $pattern = array(
            //英文标点符号
            "/[[:punct:]]/i",
            //中文标点符号
            '/['.$char.']/u',
            '/[ ]{2,}/'
        );
        return preg_replace($pattern, '', $t);
    }


    /**
     * 根据经纬度算距离
     *
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return float
     */
    public static function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $R = 6374.004;
        // 经度差值
        $dx = $lng1 - $lng2;
        // 纬度差值
        $dy = $lat1 - $lat2;
        // 平均纬度
        $b = ($lat1 + $lat2) / 2;
        // 东西距离
        $Lx = deg2rad($dx) * $R * cos(deg2rad($b));
        // 南北距离
        $Ly = $R * deg2rad($dy);
        // 用平面的矩形对角距离公式计算总距离
        return sqrt($Lx * $Lx + $Ly * $Ly);
    }
}