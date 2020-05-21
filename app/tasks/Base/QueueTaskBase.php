<?php
namespace App\Tasks\Base;

/**
 * 队列任务消费者
 * 循环处理
 * 对数据进行异步处理
 */
use App\Sdks\Constants\Base\QueueTaskConfig;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\LogHelper;
use Phalcon\Cli\Task;

class QueueTaskBase extends Task
{

    /**
     * 队列消费者
     * 1.监听tube
     * 2.获取待处理任务
     * 3.调用QueueTaskConfig配置
     * 4.执行配置的指定函数
     * 5.任务处理完毕后,从tube里删除任务
     * 占用一定内存后,退出当前进程
     * @param $tube
     */
    public function run($tube)
    {

        $this->queue->watch($tube);

        //最大使用分配内存的80%
        $max_use_memory = (int)ini_get('memory_limit') * 0.8;

        while ( $job = $this->queue->reserve() ) {

            $body = unserialize($job->getData());

            try{

                $taskType= $body['task_type'];
                if(!isset(QueueTaskConfig::$SETTINGS[$taskType]['exec_func'])){
                    throw new \Exception("task type: " .$taskType . " 未配置队列任务的执行函数",-1);
                }

                list($class,$method) = explode("::",QueueTaskConfig::$SETTINGS[$taskType]['exec_func']);
                //调用任务消费者
                $ret = CommonHelper::callMethod($class,$method,[$body['data']]);
                //$ret = $class::$method($body['data']);

                if(!$ret){
                    QueueService::saveFailedTask($body);
                }

                //执行完毕后,从tube中删除任务
                $this->queue->delete($job);

                //发出退出当前进程信号
                if(isset($ret['_exit_'])){
                    LogHelper::debug("exit_worker", "tube:{$tube}");
                    exit();
                }

            }catch (\Exception $e){

                QueueService::saveFailedTask($body);
                $this->queue->delete($job);

                //另一种做法是释放job
                //$this->queue->release($job);

                $error = sprintf("Error Code: %s | %s | %s",$e->getCode(),$e->getMessage(),$e->getTraceAsString());
                LogHelper::error('QueueError', $error);
            } finally {
                //获取当前脚本实际使用内存 退出当前脚本等待重启
                $use_memory = round(memory_get_usage(true) / 1048576, 2);
                if($use_memory >= $max_use_memory){
                    LogHelper::debug("{$tube}_memory", "already use memory {$use_memory}M");
                    exit();
                }
            }
        }
    }


}