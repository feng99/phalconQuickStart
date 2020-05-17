<?php

return [
    '/' => [
        "controller" => 'index',
        "action"     => 'index',
    ],
    '/:controller/:action/:params' => [
        "controller" => 1,
        "action"     => 2,
        "params"     => 3,
    ],
];
