<?php

use App\Backend\Controllers\ControllerBase;
use App\Sdks\Constants\Base\QueueTaskConfig;
use App\Sdks\Dao\UserDao;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Models\UserModel;
use App\Sdks\Services\Base\QueueService;
use App\Sdks\Services\UserService;

/**
 * 测试控制器
 * @deprecated
 */
class TestController extends ControllerBase
{

    /**
     * @throws JsonFmtException
     */
    public function indexAction()
    {
        try {
            //$user = UserModel::findFirst(["id"=>1]);
            $this->getFlash()->successJson("4ff");
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }


    public function rpcAction()
    {
        $client = new Yar_Client("http://yartest.com/rpc/test");
        /* the following setopt is optinal */
        $client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);

        /* call remote service */
        $result = $client->testAction(100);
    }

    /**
     * 缓存操作测试
     */
    public function cacheAction()
    {
        $redis = DiHelper::getRedis();
        $redis->set('key','testdata', 10);
        var_dump($redis->get('key'));
    }


    /**
     * 缓存封装操作测试
     */
    public function fromCacheAction()
    {
        die('4');
        try {

            $userInfo = UserService::getUserInfo(1);
//            $userInfo =  UserDao::getEntityById(4);

         /*   $userInfo = UserModel::findFirst([
                [
                    "conditions" => " uid = :uid:",
                    'bind'       =>[
                        'uid' => 100
                    ]
                ]
            ]);*/

            //$userInfo = \App\Sdks\Dao\UserDao::findFirstById(100);

            //$userInfo = UserService::getUserInfo(1);
            //$userInfo = UserService::getUserInfoDelCache();
            $this->getFlash()->successJson($userInfo);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * 队列添加任务 测试
     * 如果添加失败,数据会记录在log_queue_task表
     */
    public function queueAction()
    {

        $data = [
            'userId' => 'zhangsan'
        ];

        $jobId = QueueService::sendToQueue(QueueTaskConfig::SAVE_USER_LOGIN_INFO_KEY, $data);
        var_dump("任务id:",$jobId);
    }

}
