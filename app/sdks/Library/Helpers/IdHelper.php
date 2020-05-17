<?php

namespace App\Sdks\Library\Helpers;

/**
 * ID生成类库
 *
 * 
 */
class IdHelper
{
    /**
     * 设置node节点ID
     *
     * @param int $nodeId
     */
    public static function setNodeId(int $nodeId)
    {
        ini_set('donkeyid.node_id', $nodeId);
    }

    /**
     * 获取node节点ID
     *
     * @return int
     */
    public static function getNodeId() : int
    {
        $nodeId = ini_get('donkeyid.node_id');

        return $nodeId;
    }

    /**
     * 设置node节点时间戳
     *
     * @param int $time
     */
    public static function setEpochTime(int $time)
    {
        ini_set('donkeyid.epoch', $time);
    }

    /**
     * 获取node节点时间戳
     *
     * @param  int $time
     * @return int
     */
    public static function getEpochTime(int $time = 0) : int
    {
        $time = $time > 0 ? $time : ini_get('donkeyid.epoch');

        return $time;
    }

    /**
     * 获取单个唯一ID
     *
     * @return int
     */
    public static function getNextId() : int
    {
        $id = dk_get_next_id();

        return $id;
    }

    /**
     * 获取多个唯一ID
     *
     * @param  int  $num
     * @param  int  $time
     * @return array
     */
    public static function getNextIds(int $num, int $time = 0) : array
    {
        if ($time) {
            $data = dk_get_next_ids($num, $time);
        } else {
            $data = dk_get_next_ids($num);
        }

        return $data;
    }

    /**
     * 解析唯一ID
     *
     * @param  int  $id
     * @return array
     */
    public static function parseNextId(int $id) : array
    {
        $id = dk_parse_id($id);

        return $id;
    }

    /**
     * 获取单个10进制ID
     *
     * @return int
     */
    public static function getTsId() : int
    {
        $id = dk_get_ts_id();

        return $id;
    }

    /**
     * 获取多个10进制ID
     *
     * @param  int  $num
     * @param  int  $time
     * @return array
     */
    public static function getTsIds(int $num, int $time = 0) : array
    {
        if ($time) {
            $data = dk_get_ts_ids($num, $time);
        } else {
            $data = dk_get_ts_ids($num);
        }

        return $data;
    }

    /**
     * 解析10进制ID
     *
     * @param  int  $id
     * @return array
     */
    public static function parseTsId(int $id) : array
    {
        $id = dk_parse_ts_id($id);

        return $id;
    }

    /**
     * 获取日期时间型字符串ID
     *
     * @return string
     */
    public static function getDtId() : string
    {
        $id = dk_get_dt_id();

        return $id;
    }
}