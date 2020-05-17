<?php

namespace App\Sdks\Core\System\Events;

use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Events\Manager as EventsManager;

/**
 * 调度器
 *
 * 
 */
class DispatchEvents extends EventsManager
{
    public function __construct()
    {
        $dispatchers = $this->getConfig()->class;
        foreach ($dispatchers as $event_type => $handler) {
           $this->attach($event_type, $this->handler($handler));
        }
    }

    /**
     * 获取配置
     *
     * @return object
     */
    protected function getConfig()
    {
        $config = DiHelper::getConfig();
        $config = $config->system->plugins->dispatchers;

        return $config;
    }

    /**
     * 获取事件对象
     *
     * @param  string  $handler
     * @return object
     */
    protected function handler($handler)
    {
        $handler = "{$this->getConfig()->namespace}\\{$handler}";
        $handler = new $handler();

        return $handler;
    }

}