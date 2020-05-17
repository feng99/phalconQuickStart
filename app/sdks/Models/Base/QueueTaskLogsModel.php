<?php
/**
 * 队列任务记录
 */

namespace App\Sdks\Models\Base;


class QueueTaskLogsModel extends ModelBase
{

    public $id         = 0;
    public $task_type  = 0;
    public $data       = '';
    public $is_success = 0;
    public $put_date   = 0;
    public $exec_date  = 0;

    /**
     * 设置统计数据库句柄
     *
     * @return \Phalcon\Mvc\Model
     */
    public function setStatConnection()
    {
        return $this->setConnectionService('db');
    }

    public function getSource()
    {
        return "log_queue_task";
    }

}