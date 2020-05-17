<?php
/**
 * 队列配置
 */

namespace App\Sdks\Constants\Base;


class QueueTaskConfig
{

    /**
     * 用户登录记录
     */
    const SAVE_USER_LOGIN_LOG_KEY = 1;

    /**
     * 用户登录次数
     */
    const SAVE_USER_LOGIN_INFO_KEY = 2;




    /**
     * 发送通知任务
     */
    const SEND_NOTICE_MSG = 3;




    /**
     * Es队列
     */
    const ELASTIC_KEY = 4;


    /**
     * 发送 提现失败 报警邮件
     */
    const SEND_ERROR_MAIL = 5;




    /**
     * tube 任务管道
     * exec_func 消费者回调的函数  由哪个函数来处理这个任务
     * @var array
     */
    public static $SETTINGS = [
        self::SAVE_USER_LOGIN_LOG_KEY           => [
            'tube'      => QueueTube::ASYNC_RECORD_DATA,
            'exec_func' => 'App\Sdks\Services\UserLoginLogService::save',
        ],
        self::SAVE_USER_LOGIN_INFO_KEY          => [
            'tube'      => QueueTube::ASYNC_RECORD_DATA,
            'exec_func' => 'App\Sdks\Services\UserLoginInfoService::save',
        ],
        self::SEND_NOTICE_MSG                   => [
            'tube'      => QueueTube::SEND_NOTICE_MSG,
            'exec_func' => 'App\Sdks\Services\NoticeService::sendNotice',
        ],
        self::ELASTIC_KEY                       => [
            'tube'      => QueueTube::MAINT_SEARCH_INDEX,
            'exec_func' => 'App\Sdks\Services\SearchService::execQueue',
        ],
        self::SEND_ERROR_MAIL            => [
            'tube'      => QueueTube::SEND_MAIL,
            'exec_func' => 'App\Sdks\Library\MailHelper::sendMail',
        ]
    ];

}
