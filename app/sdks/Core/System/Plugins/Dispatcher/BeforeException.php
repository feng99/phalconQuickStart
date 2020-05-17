<?php

namespace App\Sdks\Core\System\Plugins\Dispatcher;

use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Exceptions\JsonpFmtException;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

/**
 * 抛出异常前触发插件
 *
 * 
 */
class BeforeException extends Plugin
{
    protected $flash;
    protected $request;

    public function __construct()
    {
        $this->flash   = DiHelper::getShared('flash');
        $this->request = DiHelper::getShared('request');
    }

    /**
     * 执行路由前触发
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @param Exception $e
     * @return void
     * @throws \App\Sdks\Library\Exceptions\HtmlFmtException
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, $e)
    {
        // 处理404异常
        if ($e instanceof DispatchException) {
            if ($this->request->isPost()) {
                $show_msg = '404 NOT FOUND';
                $this->flash->errorJson(-1, $show_msg);
            } else {
                $dispatcher->forward([
                        'controller' => 'error',
                        'action'     => 'err404',
                    ]
                );
            }
        }
        // JSON格式API异常
        elseif ($e instanceof JsonFmtException) {
            $this->flash->errorJson($e->getData(), $e->getCode(), $e->getMessage());
        }
        // JSONP格式API异常
        elseif ($e instanceof JsonpFmtException) {
            $info = array(
                'ret'  => $e->getCode(),
                'msg'  => $e->getMessage(),
                'data' => $e->getData()
            );
            echo $e->getCallback() .'('. CommonHelper::json_encode($info, JSON_UNESCAPED_UNICODE, true) . ')';
        }
        // 其他异常
        else {
            $err_code = !$e->getCode() ? 500 : $e->getCode();

            // 详细错误信息
            $msg  = "\nError Code: {$err_code}";
            $msg .= "\n" . $e->getMessage() . "\n";
            $msg .= $e->getTraceAsString()."\n";
            $msg .= var_export($_REQUEST, true)."\n";

            // 记录日志
            //LogHelper::unexpected($msg);

            if (CommonHelper::isPro()) {
                $show_msg = '服务器开小差了,请稍待片刻~';
            } else {
                $show_msg = $msg;
            }

            // 输出错误信息
            $this->flash->errorJson([], -1, $show_msg);
        }

        return false;
    }

}