<?php
/**
 * 队列 tube 配置
 */

namespace App\Sdks\Constants\Base;


class QueueTube
{

    /**
     * 异步记录数据
     */
    const ASYNC_RECORD_DATA = 'async_recode_data';


    /**
     * Elastic search 索引维护
     */
    const MAINT_SEARCH_INDEX = 'maint_search_index';

    /**
     * 统计数据
     */
    const STAT_QUEUE_DATA = 'stat_queue_data';


    /**
     * 发送通知、消息队列
     */
    const SEND_NOTICE_MSG  = 'send_notice_msg';
    

    /**
     * 延时任务队列
     * 如:1.处理问题过期状态 2.育儿-推荐管理
     */
    const DELAY_TASK  = 'delay_task';

    /**
     *  多进程处理队列
     */
    const WORKER_PROCESS_DATA   = 'worker_process_data';

    /**
     *  发送邮件队列
     *  如:
     *    1.crit异常日志邮件
     *    2.提现失败报警邮件
     *    3.退款失败报警邮件
     */
    const SEND_MAIL = 'send_mail';


    /**
     *  发送短信队列
     */
    const SEND_SMS = 'send_sms';

}
