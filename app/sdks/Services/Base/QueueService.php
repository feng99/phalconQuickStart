<?php
/**
 * 队列操作类
 */

namespace App\Sdks\Services\Base;

use App\Sdks\Constants\Base\QueueTaskConfig;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\LogHelper;
use App\Sdks\Models\Base\QueueTaskLogsModel;
use Pheanstalk\PheanstalkInterface;


class QueueService extends ServiceBase
{

    /**
     * 放入队列，异步同步数据
     *
     * @param int $taskType     任务所属管道
     * @param array $data       传递给任务消费者的参数
     * @param int $delay        延时任务 单位:秒s  default 0
     * @param int $priority     任务优先级
     *
     * @return bool
     */
    public static function sendToQueue($taskType, $data,$delay = 0,$priority = PheanstalkInterface::DEFAULT_PRIORITY)
    {
        $queue_data= [];
        try {
            $queue = DiHelper::getQueue();
            $queue_data = [
                'task_type' => $taskType,
                'data'      => $data,
                'add_time'  => time(),
            ];
            $job_id = $queue
                ->useTube(QueueTaskConfig::$SETTINGS[$taskType]['tube'])
                ->put(serialize($queue_data),$priority,$delay);
            if(!$job_id){
                throw new \Exception('queue error! put job error');
            }
            return $job_id;
        } catch(\Exception $e){
            //记录错误数据
            self::saveFailedTask($queue_data);

            //记录日志
            $error = sprintf("Error Code: %s | %s | %s",$e->getCode(),$e->getMessage(),$e->getTraceAsString());
            LogHelper::error('QueueError', $error);

            return false;
        }

    }



    

    /**
     * 记录执行失败的任务
     *
     * @param $task
     */
    public static function saveFailedTask($task)
    {
        $data = [
            'task_type'  => $task['task_type'],
            'data'       => CommonHelper::jsonEncode($task['data']),
            'is_success' => 0,
            'put_date'   => date('Y-m-d H:i:s', $task['add_time']),
            'exec_date'  => date('Y-m-d H:i:s', time()),
        ];

        $queueLog = new QueueTaskLogsModel();
        $queueLog->save($data);
    }
    

    /**
     * 放入OSS队列，异步同步数据
     *
     * @param  array  $data
     * @param  string $tube
     * @return mixed
     */
    /*public static function sendOssQueue($data, $tube = 'save_data')
    {
        try {
            $queue = self::getShared('oss');
            $queue_data = [
                'data'     => $data,
                'add_time' => time(),
            ];
            $job_id = $queue
                ->useTube($tube)
                ->put(serialize($queue_data));
            if (!$job_id) {
                throw new \Exception('put data error');
            }

            return $job_id;
        } catch(\Exception $e){

            //记录错误数据
            LogHelper::statLog('oss_error_data', $queue_data);

            //记录日志
            $error = sprintf("Error Code: %s | %s | %s",$e->getCode(),$e->getMessage(),$e->getTraceAsString());
            LogHelper::error('oss', $error);

            return false;
        }
    }*/



    /**
     * 放入队列，异步同步数据 - 统计
     *
     * @param $event [事件类型]
     * @param $data [数据]
     * @return mixed
     */
    /*public static function sendStatQueue($event, $data)
    {
        try {
            $queue = self::getShared('stat_queue');
            $queue_data = [
                'event'    => $event,
                'data'     => $data,
                'add_time' => time(),
            ];
            $job_id = $queue
                ->useTube(QueueTube::STAT_QUEUE_DATA)
                ->put(serialize($queue_data));
            if(!$job_id){
                throw new \Exception('put data error');
            }

            return $job_id;
        } catch(\Exception $e){
            //记录错误数据

            //记录日志
            $error = sprintf("Error Code: %s | %s | %s",$e->getCode(),$e->getMessage(),$e->getTraceAsString());
            LogHelper::error('queue.log', $error);

            return false;
        }
    }*/

} 