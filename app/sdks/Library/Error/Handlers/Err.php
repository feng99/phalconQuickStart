<?php

namespace App\Sdks\Library\Error\Handlers;

use App\Sdks\Library\Error\Constants\ErrLevel;
use App\Sdks\Library\Error\ErrorHelper;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Error\Extensions\ErrExtension;

/**
 * 错误处理基类
 *
 * 
 */
class Err
{
    /**
     * 未知错误
     *
     * @var int
     */
    const UNKNOWN_ERR      = -1;

    /**
     * 全局错误
     *
     * @var array
     */
    protected $global_msgs = [
        self::UNKNOWN_ERR => '未知错误!',
    ];

    /**
     * 错误详情数组
     *
     * @var array
     */
    protected $msgs       = [];
    
    /**
     * 错误日志
     *
     * @var string
     */
    protected $log_file   = '';
    
    /**
     * 错误码
     *
     * @var int
     */
    protected $err_code    = 0;

    /**
     * 用户自定义信息
     *
     * @var null
     */
    protected $custom_info = null;

    /**
     * 需要返回的数据
     *
     * @var array
     */
    protected $ret_data    = [];

    /**
     * 构造函数
     *
     * @param int   $code            错误码
     * @param mixed $custom_info     用户自定义的信息，如果为字符串则会存储进log中；如果是数组则挨个替换错误信息中的可变参数。
     */
    public function __construct($code, $custom_info = null)
    {
        $this->err_code    = $code;
        $this->custom_info = $custom_info;

        // 获取log路径
        $class = get_class($this);
        if ( strpos($class, '\\') !== false ) {
            $arr   = explode('\\', $class);
            $class = end($arr);
        }

        $this->log_file   = $class . '.log';
    }

    /**
     * 根据错误码生成对应的类对象
     *
     * @return Err object
     */
    public static function create()
    {
        $params = func_get_args();
        $code   = $params[0];

        // 获取类名
        if ($code < 2000) {
            $class_name = 'SysErr';
        } else {
            $class_name = 'CoreLogicErr';
        }

        $class = __NAMESPACE__ . '\\' . $class_name;

        $ref_method = new \ReflectionMethod($class,  '__construct');
        $construct_params = $ref_method->getParameters();
        if (!empty($construct_params)) {
            $ref_class = new \ReflectionClass($class);
            $obj = $ref_class->newInstanceArgs($params);
        } else {
            $obj = new $class();
        }

        return $obj;
    }

    /**
     * 设置返回的数组
     *
     * @param  mixed $ret_data
     *
     * @return $this
     */
    public function setRetData($ret_data) {
        $this->ret_data = $ret_data;

        return $this;
    }

    /**
     * 通过错误码获取真实错误信息
     *
     * @param  int $code
     *
     * @return string
     */
    protected function getErrRealInfo($code)
    {
        if (isset($this->msgs[$code]['real_info'])) {
            $msg = $this->msgs[$code]['real_info'];
        } else {
            $this->err_code = self::UNKNOWN_ERR;
            $msg = $this->global_msgs[self::UNKNOWN_ERR];
        }

        return $msg;
    }
    
    /**
     * 通过错误码获取展示给用户的错误信息
     *
     * @param  int $code
     *
     * @return string
     */
    protected function getErrShowInfo($code)
    {
        if (isset($this->msgs[$code]['show_info'])) {
            $msg = $this->msgs[$code]['show_info'];
        } elseif (isset($this->msgs[$code]['real_info'])) {
            $msg = $this->msgs[$code]['real_info'];
        } else {
            $this->err_code = self::UNKNOWN_ERR;
            $msg = $this->global_msgs[self::UNKNOWN_ERR];
        }

        return $msg;
    }

    /**
     * 获取错误码对应的错误级别
     *
     * @param  int $code
     *
     * @return int
     */
    protected function getErrLevel($code)
    {
        if (isset($this->msgs[$code]['level'])) {
            $level = $this->msgs[$code]['level'];
        } else {
            $level = ErrLevel::ERROR;
        }

        return $level;
    }

    /**
     * 获取错误码对应的是否显示设置
     *
     * @param  int $code
     * @return int
     */
    protected function getErrShown($code)
    {
        if (isset($this->msgs[$code]['is_shown'])) {
            $is_shown = $this->msgs[$code]['is_shown'];
        } else {
            $is_shown = true;
        }

        return $is_shown;
    }

    /**
     * 上报错误信息
     *
     * @param int    $err_code
     * @param string $info
     *
     * @return void
     */
    protected function log($err_code, $info)
    {
        $level = $this->getErrLevel($err_code);

        // ERROR及以上级别才记录log
        if ($level <= ErrLevel::ERROR) {
            // 获取报错的文件及行号
            $trace  = ErrorHelper::getTrace();
            $offset = ErrorHelper::getTraceOffset($trace, get_class($this));
            $file   = $trace[$offset]['file'];
            $file  .= '(' . $trace[$offset]['line'] . ')';

            // 其他信息
            $uid = '';

            // 汇总要记录的log数据
            $msg  = 'Uid:'  . $uid . PHP_EOL;
            $msg .= 'Code:' . $err_code . PHP_EOL;
            $msg .= 'Info:' . $info . PHP_EOL;
            $msg .= 'File:' . $file . PHP_EOL;

            // todo 记录错误
           // LogHelper::error($this->log_file, $msg);
        }
    }

    /**
     * 记录log并抛出异常
     */
    protected function handleError()
    {
        // 获取真实错误信息
        $real_info = $this->getErrRealInfo($this->err_code);

        // 获取展示错误信息
        $show_info = $this->getErrShowInfo($this->err_code);

        $isset_showinfo = $real_info == $show_info ? false : true;

        $info = $this->custom_info;
        if (!empty($info)) {
            // 如果是数组，需要格式化错误信息
            if (is_array($info)) {
                // 两种信息都需要进行格式化
                $real_info = call_user_func_array('sprintf', array_merge([$real_info], $info));
                $show_info = call_user_func_array('sprintf', array_merge([$show_info], $info));

                // 未设置show_info时需要与real_info保持同步
                if (!$isset_showinfo) {
                    $real_info = $show_info;
                }
            } elseif (is_string($info)) {
                $show_info .= ' | diyInfo:'.$info;
            }
        }

        $this->log($this->err_code, $real_info);
        $this->throwException($this->err_code, $show_info, $this->ret_data);
    }

    /**
     * 抛出异常
     *
     * @param  int     $err_code
     * @param  string  $msg
     * @param  array   $data
     * @throws CustomException
     */
    protected function throwException($err_code, $msg, $data)
    {
        $is_shown  = $this->getErrShown($err_code);
        if ($is_shown) {
            throw new CustomException($msg, $err_code, $data);
        }
    }
}
