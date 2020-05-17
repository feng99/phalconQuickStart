<?php

return [
    'redis' => [
        'uniqueId'   => 'code',
        'host'       => '127.0.0.1',
        'port'       => 6379,
        'persistent' => false,
        'lifetime'   => 3600,
        'prefix'     => 'demo_session_',
    ],
];
