<?php

namespace App\Sdks\Core\System\Application;

use Phalcon\Mvc\Application;

/**
 * 自定义应用类库
 *
 * 
 */
class CustomApplication extends Application
{
    /**
     * Register the services here to make them general or register
     * in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {

    }

    /**
     * 运行应用
     */
    public function run()
    {
        $this->handle()->send();
    }
}
