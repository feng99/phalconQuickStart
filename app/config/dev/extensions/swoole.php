<?php

return [
        'bind' => '127.0.0.1:9501',
        //swoole settings
        'settings' => [
            'worker_num'    => 2,
            'daemonize'     => false,
            'user'          => 'www',
            'group'         => 'www'
        ]
];