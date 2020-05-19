<?php

namespace App\Rpc;


class RpcBase extends \Phalcon\CLI\Task
{

    const YAR_HEADER_SIZE = 82;
    const YAR_MAGIC_NUM = 0x80DFEC60;
    const YAR_PACK_TYPE = 'PHP';
    //const YAR_PACK_TYPE = 'JSON';
    //const YAR_PACK_TYPE = 'MSGPACK';

    private $res_data = [];


    public function main($params)
    {
        $header = $this->parseHeader($params['data']);
        $request_id = $header['id'] ?? 0;

        try {

            if ($header["magic_num"] !== self::YAR_MAGIC_NUM) {
                throw new \RuntimeException('unsupported packager1', -1);
            }

            $request = $this->unpackBody($params['data']);

            if ($request === false) {
                throw new \RuntimeException('unsupported packager2', -1);
            } else if (!$request) {
                throw new \RuntimeException('malformed request body', -1);
            }

            $request_id = !empty($request['i']) ? $request['i'] : $request_id;

            if (!method_exists($this, $request['m'])) {
                throw new \RuntimeException("method '{$request['m']}' was not found on PRC server.", -1);
            }

            $args = $this->getRelClassParams($request['m'], $request['p']);
            $res = call_user_func_array([$this, $request['m']], $args);

            //$res = call_user_func([$this,$request['m']],$request['p']);
            if ($res === null) {
                $res = $this->res_data;
            }
            $output = $this->response($request_id, 0, $res, self::YAR_PACK_TYPE);

        } catch (\Exception $e) {
            echo $e->getMessage();
            //todo log

            $err_msg = $e->getCode() < 0 ? $e->getMessage()  : 'Tcp Server Error';
            $output = $this->response($request_id, 1, $err_msg, self::YAR_PACK_TYPE);
        }

        $svr = $params['server'];

        $svr->send($params['fd'], $output);
        $svr->close($params['fd']);

    }


    protected function parseHeader($data)
    {
        return unpack("Nid/nversion/Nmagic_num/Nreserved/A32provider/A32token/Nbody_len", substr($data, 0, self::YAR_HEADER_SIZE));
    }


    protected function unpackBody($data)
    {
        $ret = false;
        //echo substr($data, self::YAR_HEADER_SIZE + 8);

        $buf = substr($data, self::YAR_HEADER_SIZE, 8);

        if (strncmp($buf, 'PHP', 3) == 0) {
            $ret = unserialize(substr($data, self::YAR_HEADER_SIZE + 8));
        } else if (strncmp($buf, 'JSON', 4) == 0) {
            $ret = json_decode(substr($data, self::YAR_HEADER_SIZE + 8), true);
        } else if (strncmp($buf, 'MSGPACK', 7) == 0) {
            $ret = msgpack_unpack(substr($data, self::YAR_HEADER_SIZE + 8));
        }

        return $ret;
    }

    protected function response($request_id, $status, $data, $pack_type = 'PHP')
    {

        $body = [
            'i' => $request_id,
            's' => $status
        ];

        if ($status == 0) {
            $body["r"] = $data;
        } else {
            $body["e"] = $data;
        }

        switch (strtoupper($pack_type)) {
            case "PHP":
                $packed = serialize($body);
                break;
            case "JSON":
                $packed = json_encode($body);
                break;
            case "MSGPACK":
            default:
                $packed = msgpack_pack($body);
        }

        $header = pack("NnNNA32A32N", $request_id, 0, self::YAR_MAGIC_NUM, 0, "Yar PHP TCP Server", "", strlen($packed) + 8);

        return $header . str_pad($pack_type, 8, "\0") . $packed;
    }


    /**
     * @param $method
     * @param $data
     * @return array
     * @throws \ReflectionException
     */
    protected function getRelClassParams($method, $data): array
    {
        $rel_class = new \ReflectionClass($this);
        $class_method = $rel_class->getMethod($method);

        $args = [];
        foreach ($class_method->getParameters() as $i => $p) {

            if (isset($data[$i])) {
                $args[] = $data[$i];
            } else if ($p->isDefaultValueAvailable()) {
                $args[] = $p->getDefaultValue();
            } else {
                $args[] = null;
            }
        }

        return $args;
    }

    /**
     * @param array $data
     * @return array
     */
    public function success($data = []): array
    {
        $this->res_data = ['code' => 0, 'msg' => 'ok', 'data' => $data];
        return $this->res_data;
    }


    public function error($msg = 'error', $code = 500): array
    {
        $code = $code == 0 ? -1 : $code;
        $this->res_data = ['code' => $code, 'msg' => $msg, 'data' => []];
        return $this->res_data;
    }

}

