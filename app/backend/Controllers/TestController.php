<?php

use App\Backend\Controllers\ControllerBase;
use App\Sdks\Constants\Base\QueueTaskConfig;
use App\Sdks\Dao\UserDao;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\JWT;
use App\Sdks\Services\Base\QueueService;
use App\Sdks\Services\UserService;
use Phalcon\Crypt;
use Phalcon\Http\Request;

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

            //var_dump( $this->request->getHeaders());
            //var_dump( $this->request->getPost());
            $userId = $this->request->getHeader("Userid");
            var_dump($userId);

            //$user = UserModel::findFirst(["id"=>1]);
            $this->getFlash()->successJson("test ok");
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
        $redis->set('key', 'testdata', 10);
        var_dump($redis->get('key'));
    }


    /**
     * 缓存封装操作测试
     */
    public function fromCacheAction()
    {
        try {

            $userInfo = UserService::getUserInfo(2);
            $this->getFlash()->successJson($userInfo);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * Entity封装测试
     */
    public function entityAction()
    {
        try {
            $userInfo = UserService::getEntityById(5);
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
        var_dump("任务id:", $jobId);
    }


    /**
     * 从缓存中批量获取数据
     * 缓存封装操作测试
     */
    public function fromCacheMGetAction()
    {
        try {
            $ids = [2, 3, 4];
//            $userList = UserDao::findInList($ids);
            $userList = UserDao::findInListFromCacheMGet($ids);
            $this->getFlash()->successJson($userList);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * jwt 加密测试函数
     * @throws JsonFmtException
     */
    public function jwtEncodeAction()
    {
        //校验用户登陆状态
        //校验用户是否被禁用
        try {
            //$payload, $key, $alg = 'HS256', $keyId = null, $head = null
            $secretKey = DiHelper::getConfig()->jwtAuth->secretKey;
            var_dump($secretKey);

            $token = JWT::encode(["userId" => "123458"], $secretKey);
            $this->getFlash()->successJson(['token' => $token]);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * jwt 测试函数
     * @throws JsonFmtException
     */
    public function jwtDecodeAction()
    {
        try {
            $secretKey = DiHelper::getConfig()->jwtAuth->secretKey;
            var_dump($secretKey);die();
            $tokenb = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiIxMjM0NTgifQ.-XLFdIggONBJsrUSpu16QLfWw6peaY1H-kwzeMbpKqc';
            $body = JWT::decode($tokenb, $secretKey);
            var_dump($body);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * AES 加密/解密测试
     * @throws Crypt\Exception
     * @throws Crypt\Mismatch
     * @throws JsonFmtException
     */
    public function aesAction()
    {
        try {
            // Create an instance
            $crypt = new Crypt();

            //$crypt->setCipher('aes-256-ctr');
            //$crypt->setHashAlgo('aes-256-cfb');

            // Force calculation of a digest of the message based on the Hash algorithm
            //$crypt->useSigning(true);

            $key = "T4\xb1\x8d\xa9\x98\x664t7w!z%C*F-Jk\x98\x05\\\x5c";
            $text = '{ "code": "2000", "msg": "参数错误:【用户名必须】", "body": {} }';

            // Perform the encryption
            $encrypted = $crypt->encrypt($text, $key);
            //var_dump('加密后');
            var_dump($encrypted);
            // Now decrypt
            echo $crypt->decrypt($encrypted, $key);
            var_dump("解密后:");
            //var_dump($crypt);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }


}
