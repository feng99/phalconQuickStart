<?php

namespace App\Sdks\Core\System\Plugins\Dispatcher;

use App\Sdks\Library\Constants\RouteConfig;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Error\Handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;

/**
 * 执行路由前触发插件
 *
 * 
 */
class BeforeExecuteRoute extends Plugin
{

    protected $router;
    protected $request;

    public function __construct()
    {
        $this->router  = DiHelper::getShared('router');
        $this->request = DiHelper::getShared('request');
    }

    /**
     * 执行路由前触发
     *
     * @param  Event       $event
     * @param  Dispatcher  $dispatcher
     * @throws JsonFmtException
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        try {

            // 获取执行路径 命名空间+控制器+动作
            $n    = $dispatcher->getParam('_n');
            $c    = $dispatcher->getParam('_c');
            $a    = $dispatcher->getParam('_a');
            $path = "{$n}\\{$c}::{$a}";

            $route_config = RouteConfig::$SETTINGS;
            if (isset($route_config[$path])) {
                foreach ($route_config[$path] as $plugin_name => $plugin_config) {
                    $this->{$plugin_name}($plugin_config);
                }
            }
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取数据
     *
     * @return array
     */
    protected function getData()
    {
        return $this->request->getPost();
    }

    /**
     * 获取数据
     *
     * @param  array $data
     * @return void
     */
    protected function setData(array $data)
    {
        $_POST =  CommonHelper::arrayMerge($this->getData(), $data);
    }

    /**
     * 过滤器
     *
     * @param array $filters
     * @throws \ReflectionException
     */
    protected function filter(array $filters)
    {
        foreach ($filters as $filter) {
            $data = CommonHelper::callMethod($filter, 'filters', $this->getData());
            $this->setData($data);
        }
    }

    /**
     * 验证器
     *
     * @param array $validates
     * @throws \ReflectionException
     */
    protected function validate(array $validates)
    {
        foreach ($validates as $validate) {
            $valdate = CommonHelper::callMethod($validate, 'validations', $this->getData());
            if ($valdate->fail()) {
                foreach ($valdate->getErrors() as $error) {
                    $err = Err::create(CoreLogic::INVALID_PARAM, [$error['msg']]);
                    ErrorHandle::throwErr($err);
                }
            } else {
                // 验证通过的安全数据
                //$safe_data = $valdate->getSafeData();
                // 原始数据
                //$post_data = $valdate->all();
            }
        }
    }


    /**
     * 检查请求
     */
    protected function checkRequest()
    {
        if (!$this->request->isPost()) {
            $err = Err::create(CoreLogic::REQUEST_METHOD_ERROR);
            ErrorHandle::throwErr($err);
        }
    }

}
