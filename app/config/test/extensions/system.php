<?php

return [
    'plugins' => [
        // 分发器事件管理器
        'dispatchers' => [
            'namespace' => '\App\Sdks\Core\System\Plugins\Dispatcher',
            'class'     => [
                'dispatch:beforeDispatchLoop' => 'BeforeDispatchLoop',
                'dispatch:beforeExecuteRoute' => 'BeforeExecuteRoute',
                'dispatch:beforeException'    => 'BeforeException',
            ]
        ]
    ],

];
