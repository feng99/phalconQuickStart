<?php
/**
 * 发送短信 任务 消费者
 * 使用方式：php app/modules/www/cli.php sms exec
 * 可根据这个 扩展其他队列任务消费者
 * 同一个业务用一个tube即可
 */
use \App\Sdks\Constants;
use App\Sdks\Constants\Base\QueueTube;
use App\Tasks\Base\QueueTaskBase;

class SmsTask extends QueueTaskBase
{

    public function execAction()
    {
        //传入指定的Tube
        parent::run(QueueTube::SEND_SMS);
    }
}