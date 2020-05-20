<?php

use App\Backend\Controllers\ControllerBase;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Services\UserService;

/**
 * 用户控制器
 *
 * 
 */
class UserController extends ControllerBase
{
    /**
     * 注册用户
     *
     * @throws JsonFmtException
     */
    public function registerAction()
    {
        try {
           /* $data = [
                'user_name' => $this->request->getPost('user_name'),
                'password'  => $this->request->getPost('password'),
            ];
            $ret = UserService::register($data);

            $this->getFlash()->successJson($ret);*/
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取用户信息
     *
     * @throws JsonFmtException
     */
    public function loginAction()
    {
        try {
            /*$data = [
                'user_name' => $this->request->getPost('user_name'),
                'password'  => $this->request->getPost('password'),
            ];
            $ret = UserService::login($data);

            $this->getFlash()->successJson($ret);*/
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取用户信息
     *
     * @throws JsonFmtException
     */
    public function getUserInfoAction()
    {
        try {
            $uid = $this->request->getPost('uid');
            $uid = '2';
            $ret = UserService::getUserInfo($uid);
            $this->getFlash()->successJson($ret);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取用户信息
     *
     * @throws JsonFmtException
     */
    public function getUserListAction()
    {
        try {
            $uid = $this->request->getPost('uid');
            $uid = '2';
            $ret = UserService::getUserList($uid);
            $this->getFlash()->successJson($ret);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取用户信息
     *
     * @throws JsonFmtException
     */
    public function findCustomAction()
    {
        try {



            //$sql = "select id from t_users where id = :id ";
          /*  $sql = "select id from t_users where id > :id ";
            $bind = [
                'id' => 0
            ];
            $res = \App\Sdks\Library\Helpers\DiHelper::getDB()->query($sql,$bind)->fetchAll();
            //$res->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $this->getFlash()->successJson($res);*/


            $custom = \App\Sdks\Dao\UserDao::findOneData();
            $this->getFlash()->successJson($custom);


          /*  $custom = \App\Sdks\Dao\UserDao::findCustom();
            $this->getFlash()->successJson($custom);*/
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }



}
