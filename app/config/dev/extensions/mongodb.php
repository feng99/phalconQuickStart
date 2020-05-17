<?php

return [
    [
        'host'     => '127.0.0.1',
        'port'     => '27017',
        'username' => '',
        'password' => '',
    ],
    'database'         => 'test',
    'replica_set_name' => 'demobj',
    'options'          => [
        'authMechanism'    => 'MONGODB-CR',
        'connectTimeoutMS' => 10000,
    ],
];
