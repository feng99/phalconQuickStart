<?php

namespace App\Sdks\Library\Error\Exceptions;

/**
 * 自定义异常类
 *
 * 
 */
class CustomException extends \Exception
{
    protected $data = [];

    /**
     * 初始化异常
     *
     * @param   string     $message
     * @param   int        $code
     * @param   array      $data
     * @param  \Exception  $previous
     */
    public function __construct($message, $code, $data = [], \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->data = $data;
    }

    /**
     * 获取数据
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
