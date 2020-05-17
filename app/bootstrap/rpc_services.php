<?php

/***
 * 加载rpc server
 */

$rpc_list = [
    "/rpc/test"
];

$api_url  = $_SERVER['REQUEST_URI'];
if(in_array($api_url,$rpc_list)){
    $service = new Yar_Server(new RpcController());
    $service->handle();
}
