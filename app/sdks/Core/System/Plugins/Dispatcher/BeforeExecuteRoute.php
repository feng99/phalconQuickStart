<?php

namespace App\Sdks\Core\System\Plugins\Dispatcher;

use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Error\Handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Validate\BaseValidate;
use App\Sdks\Validate\ValidateRouteConfig;
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
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @throws JsonFmtException
     * @throws \ReflectionException
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        try {

            // 获取执行路径 命名空间+控制器+动作
            $n    = $dispatcher->getParam('_n');
            $c    = $dispatcher->getParam('_c');
            $a    = $dispatcher->getParam('_a');
            //$path = "{$n}\\{$c}::{$a}";
            $path    = $dispatcher->getParam('_path');
            $routeConfig = ValidateRouteConfig::$SETTINGS;
            if (!empty($routeConfig[$path])) {
                //过滤器
                if(!empty($routeConfig[$path]['filter'])){
                    $this->filter([$routeConfig[$path]['filter']]);
                }
                //验证器
                $validateConf = $routeConfig[$path]['validate'];
                if(!empty($validateConf)){
                    if (count($validateConf) == count($validateConf, 1)) {
                        $this->validate([$validateConf]);
                    } else {
                        foreach ($validateConf as $validate) {
                            $this->validate([$validate]);
                        }
                    }
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
     * 参数验证器
     * @param $rules
     */
    protected function validate($rules)
    {
        $baseValidate = new BaseValidate();
        $validateRes  = $baseValidate->validations($rules,$this->getData());
        if ($validateRes->failed()) {
            foreach ($validateRes->getErrors() as $error) {
                ErrorHandle::throwErr(Err::create(CoreLogic::INVALID_PARAM, [$error['msg']]));
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
