<?php
/**
 * 此文件存放,所有环境都一样的配置
 * 指定环境的同key配置,会覆盖此文件
 */

return [
    //CMS系统默认每页数据数量
    'default_page_size' => 20,

    'versions' => [
        // iOS版本
        'ios' => '1.0.0',
        // 安卓版本
        'android' => '1.0.0',
        // 服务器API版本
        'api' => '1.0.0',
    ],
];