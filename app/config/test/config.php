<?php

return [
    // 应用配置
    'application' => require __DIR__ . "/extensions/application.php",

    // mysql配置
    'mysql' => require __DIR__ . "/extensions/mysql.php",

    // mongodb配置
    'mongodb' => require __DIR__ . "/extensions/mongodb.php",

    // redis配置
    'redis' => require __DIR__ . "/extensions/redis.php",

    // 队列beanstalk配置
    'beanstalk' => require __DIR__ . "/extensions/beanstalk.php",

    // elastic配置
    'elastic' => require __DIR__ . "/extensions/elastic.php",

    // session配置
    'session' => require __DIR__ . "/extensions/session.php",

    // routers配置
    'routers' => require __DIR__ . "/extensions/routers.php",

    // system配置
    'system' => require __DIR__ . "/extensions/system.php",

    // logic配置
    'logic' => require __DIR__ . "/extensions/logic.php",

    // mail配置
    'mail' => require __DIR__ . "/extensions/mail.php",

];
