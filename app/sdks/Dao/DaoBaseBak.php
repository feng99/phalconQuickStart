<?php
/**
 * 代码备份
 *
 * 实体服务基类
 * 主要封装
 * 1.根据主键id查询单个对象
 * 2.根据指定字段查询单个对象
 * 3.根据主键id或者自定义字段 进行in查询
 */

namespace App\Sdks\Dao;

use App\Sdks\Constants\Base\RedisKey;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use App\Sdks\Library\Helpers\LogHelper;
use App\Sdks\Library\Helpers\Page;
use App\Sdks\Models;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Constants\Base\EntityConfig;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\System;
use App\Sdks\Services\Base\ServiceBase;


class DaoBaseBak extends Models\Base\ModelBase
{
    /**
     * 根据主键获取
     */
    const BY_ID         = 'by_id';

    /**
     * 根据自定义ID获取
     */
    const BY_CUSTOM     = 'by_custom';


    public static function getEntity($obj_id)
    {
        return self::doGetEntity($obj_id, self::BY_CUSTOM);
    }

    public static function getEntityById($id)
    {
        return self::doGetEntity($id, self::BY_ID);
    }

    /**
     * 获取实体数据-支持批量
     *
     * @param $obj_id
     * @param string $type
     * @return array
     * @throws \ReflectionException
     */
    private static function doGetEntity($obj_id, $type = self::BY_CUSTOM)
    {
        $ret = [];

        $class    = get_called_class();
        $class    = str_replace(__NAMESPACE__, '', $class);
        $pos      = strpos($class, 'Dao');
        $name     = strtolower(substr($class, 1, $pos-1));

        $settings = EntityConfig::$SETTINGS;
        if (array_key_exists($name, $settings)) {
            $cfg = $settings[$name];

            $class_name = '\App\Sdks\Models\\'.$cfg['model'];
            $method     = 'findFirst';
            $field = 'id';
            if ($type == self::BY_CUSTOM) {
                $field = $cfg['obj_id'];
            }
            if(is_array($obj_id)){
                $obj_id = array_values($obj_id);
                $method = 'find';
                $args = [
                    [
                        "conditions" => $field.' in ({'.$field.':array})',
                        'bind'       =>[
                            $field => $obj_id
                        ]
                    ]
                ];
            }else{
                $args = [
                    [
                        "conditions" => "{$field} = :{$field}:",
                        'bind'       =>[
                            $field => $obj_id
                        ]
                    ]
                ];
            }
            var_dump($class_name, $method, $args);die();
            $res = CommonHelper::callMethod($class_name, $method, $args);
            if($res) {
                $ret = $res->toArray();
                if(is_array($obj_id)){
                    $ret = array_map(function($item,$field){
                        if(isset($item[$field])){
                            $item['obj_id'] = $item[$field];
                        }
                        return $item;
                    },$ret,array_fill(0,count($ret),$field));
                }
            }

        } else {
            LogHelper::error('class_no_entity_config',$name);
            $err = Err::create(System::ENTITY_NOT_CONFIGURED);
            ErrorHandle::throwErr($err);
        }

        return $ret;
    }

    /**
     * 判断实体是否存在
     *
     * @param $obj_id
     * @return bool
     */
    public static function isExists($obj_id)
    {
        $ret = false;
        $res = self::getEntityFromCache($obj_id);

        //if ($res && $res['is_deleted'] == 0) {
        if ($res) {
            if(isset($res['is_delete']) && $res['is_delete'] == 0){
                $ret = true;
            }
            if(isset($res['is_deleted']) && $res['is_deleted'] == 0){
                $ret = true;
            }
        }
        return $ret;
    }

    /**
     * 判断实体是否存在,不存在则抛出异常
     *
     * @param $obj_id
     * @param $obj_type
     * @return bool
     */
    public static function isExistsCheck($obj_id,$obj_type = 0)
    {
        $ret = false;
        $res = self::getEntityFromCache($obj_id);

        if ($res && $res['is_delete'] == 0) {
            $ret = true;
        }else{
            $err = Err::create(CoreLogic::OBJECT_NOT_EXISTS, [$obj_type, $obj_id]);
            ErrorHandle::throwErr($err);
        }
        return $ret;
    }
}