<?php
namespace App\Rpc;



use App\Sdks\Core\System\Flash\CustomFlash;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Services\UserService;
use Phalcon\Di;

class ApiRpc extends RpcBase
{

    /**
     * 测试函数  接收一个参数
     * @param $id
     */
    public function query($id)
    {
        try{
            $data = [
                1 => ["id"=>1,"name"=>"aaa"],
                2 => ["id"=>2,"name"=>"bbb"],
            ];

            if(!isset($data[$id])){
                throw new \RuntimeException(" id:'{$id}' not found!");
            }
            $this->success($data[$id]);
        }catch (\Exception $e){
            $this->error($e->getMessage(),1200);
        }
    }

    /**
     * 测试函数  接收多个参数
     * @param $arg1
     * @param $arg2
     * @param $arg3
     */
    public function test($arg1,$arg2,$arg3)
    {
        try{
            $this->success([$arg1,$arg2,$arg3]);
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }


    /**
     * 获取单个用户信息
     * @param $id
     */
    public function getUserInfo($id)
    {
        var_dump("request parameter:",$id);
        try{
            $data = UserService::getUserInfo($id);
            $this->success($data->toArray());
        }catch (\Exception $e){
            $this->error($e->getMessage(),1200);
        }

    }

    /**
     * 获取多个用户信息
     * @param $array
     */
    public function getUserList($array)
    {
        var_dump("request parameter:",$array);
        try{
            $data = UserService::getUserList([0]);
            $this->success($data);
        }catch (\Exception $e){
            $this->error($e->getMessage(),1200);
        }

    }


  


}