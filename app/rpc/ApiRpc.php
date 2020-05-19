<?php
namespace App\Rpc;



use App\Sdks\Core\System\Flash\CustomFlash;
use Phalcon\Di;

class ApiRpc extends RpcBase
{


    public function query($id)
    {

        try{

            $data = [
                1 => ["id"=>1,"name"=>"aaa"],
                2 => ["id"=>2,"name"=>"bbb"],
            ];

            if(!isset($data[$id])){
                throw new \Exception(" id:'{$id}' not found!");
            }

            $this->success($data[$id]);
            

        }catch (\Exception $e){
            $this->error($e->getMessage(),1200);
        }

    }

    public function test($arg1,$arg2,$arg3)
    {

        try{

            $this->success([$arg1,$arg2,$arg3]);

        }catch (\Exception $e){
            $this->error($e->getMessage());
        }

    }

  


}