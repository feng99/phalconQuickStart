<?php

namespace App\Sdks\Core\System\Plugins\Dispatcher;

use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;

/**
 * 循环调度前触发插件
 *
 * 
 */
class BeforeDispatchLoop extends Plugin
{
    protected $router;
    protected $request;

    public function __construct()
    {
        $this->router  = DiHelper::getShared('router');
        $this->request = DiHelper::getShared('request');
    }

    /**
     * 循环调度前触发
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return void
     * @throws \ReflectionException
     */
    public function beforeDispatchLoop(Event $event, Dispatcher $dispatcher)
    {
        /*
        // 获取命名空间及控制器等信息
        $default_ns     = 'App\Backend\Controllers';

        $namespace      = $this->router->getNamespaceName() ?: $default_ns;
        $controller     = $this->router->getControllerName();
        $action         = $this->router->getActionName();
        $need_forward = false;

        // 获取版本号
        $version      = $this->request->getHeader('SVER') ?: SERVER_VERSION;

        // 获取配置
        $ver_config   = [];


        // 获取配置中的key名
        $vkey = str_replace($default_ns, '', $namespace);
        $vkey = strtolower(trim($vkey, '\\'));
        $vkey = $vkey ? $vkey . '\\' . $controller : $controller;

        $ver_cfg = [];
        if ( empty($ver_config[$vkey][$action]) ) {
            // 检查是否有版本文件目录存在
            $class_name = $this->router->getNamespaceName().'\\'.ucfirst($controller).'Controller';

            if (class_exists($class_name)) {
                $rf   = new \ReflectionClass($class_name);
                $path = dirname($rf->getFileName()).'/'.$controller;
                if (file_exists($path) && is_dir($path)) {
                    $files = scandir($path);
                    foreach($files as $file) {
                        if (preg_match('#V(\d)Controller#', $file, $match)) {
                            $ver_cfg[$match[1]] = [];
                        }
                    }
                }
            }
        } else {
            $ver_cfg = $ver_config[$vkey][$action];
        }

        if (!empty($ver_cfg)) {
            // 补充初始版本
            $ver_cfg[SERVER_VERSION] = [];

            // 重新排序
            ksort($ver_cfg);

            $i = 0;
            $cfg_keys = array_keys($ver_cfg);
            do {
                if ( !isset($cfg_keys[$i]) ) {
                    // 如果是最后一项则索引往回退1
                    $i--;
                    break;
                }
                // 版本比较
                $flag = $version - $cfg_keys[$i];
                if ($flag < 0) {
                    $i--;
                    break;
                } elseif ($flag == 0) {
                    break;
                }
                $i++;
            } while(true);

            // 获取请求分发参数
            if ($i > 0) {
                $need_forward = true;
                $cur_ver      = $cfg_keys[$i];
                $cur_cfg      = $ver_cfg[$cur_ver];

                $namespace    = !empty($cur_cfg['namespace']) ? $cur_cfg['namespace'] : $namespace.'\\'.ucfirst($controller);
                $controller   = !empty($cur_cfg['controller']) ? $cur_cfg['controller'] : 'V'.$cur_ver;
                $action       = !empty($cur_cfg['action']) ? $cur_cfg['action'] : $action;
            }
        }

        // 设置数据
        $dispatcher->setParams([
            '_n' => $namespace,
            '_c' => $controller,
            '_a' => $action,
        ]);
        if ($need_forward) {
            $dispatcher->setNamespaceName($namespace);
            $dispatcher->setControllerName($controller);
            $dispatcher->setActionName($action);
        }
    */}

}