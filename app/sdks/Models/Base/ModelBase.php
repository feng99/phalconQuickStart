<?php

namespace App\Sdks\Models\Base;

use App\Sdks\Library\LogHelper;
use App\Sdks\Models\Oto\OpenCityModel;
use Phalcon\Mvc\Model;
use App\Sdks\Core\Traits\CacheTraits;

/**
 * mysql实体层基类
 *
 * 
 */
class ModelBase extends Model
{


    /**
     * 设置连接句柄
     *
     * @param string $connectionService
     * @return \App\Sdks\Models\ModelBase
     */
    public function setConnectionService($connectionService)
    {
        parent::setConnectionService($connectionService);
        $this->setDbName($connectionService);

        return $this;
    }

    /**
     * 批量保存
     * @param $data
     * @param string $tableName
     * @param bool $replace
     * @return mixed
     * @author Ross
     * @throws \Exception
     */
    public function saveAll($data, $tableName = '', $replace = false)
    {
        if (empty($tableName)) {
            $tableName = $this->getSource();
        }
        if ($replace) {
            $sql = "REPLACE";
        } else {
            $sql = "INSERT";
        }
        if (!isset($data[0])) {
            throw new \Exception("参数必须是二维数组!");
        }
        $cols = implode(',', array_keys($data[0]));
        $vals = implode(',', array_fill(0, count($data[0]), '?'));
        $vals = ltrim(str_repeat(",({$vals})", count($data)), ',');
        $sql .= " INTO {$tableName} ({$cols}) VALUES {$vals}";

        $sth = $this->getWriteConnection()->prepare($sql);
        $i = 1;
        foreach ($data as $line => $row) {
            foreach ($row as $k => &$v) {
                $sth->bindParam($i, $v);
                $i++;
            }
        }

        return $sth->execute();
    }

    /**
     * 自定义查询
     *
     * @param  array $params
     * @param  bool $master
     * @return string
     */
    public static function customFind($params, $master)
    {
        $model = new static();
        $table = $model->getSource();
        $columns = [
            'columns'    => '*',
            'conditions' => '',
            'bind'       => null,
            'order'      => '',
            'limit'      => '',
            'group'      => '',
        ];
        foreach ($columns as $column => $value) {
            if (isset($params[$column])) {
                if (is_array($params[$column])) {
                    switch ($column) {
                        case 'limit' :
                            $columns[$column] = "{$params[$column]['offset']},{$params[$column]['number']}";
                            break;
                        default:
                            $columns[$column] = $params[$column];
                            break;
                    }
                } else {
                    $columns[$column] = $params[$column];
                }
            }
        }

        $sql = "select {$columns['columns']} from {$table}";
        if (!empty($columns['conditions'])) {
            $conditions = preg_replace('/:([^:]+):/', ':\\1', $columns['conditions']);
            $sql .= " where {$conditions}";
        }
        if (!empty($columns['order'])) {
            $sql .= " order by {$columns['order']}";
        }
        if (!empty($columns['limit'])) {
            $sql .= " limit {$columns['limit']}";
        }
        if (!empty($columns['group'])) {
            $sql .= " group {$columns['group']}";
        }
        if ($master) {
            //$master_select_prefix = static::$master_select_prefix;
            //$sql = "{$master_select_prefix} $sql";
        }
        $result = di($model->getDbName())->query($sql, $columns['bind']);
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);

        return $result;
    }

    /**
     * 单条数据查询
     *
     * @param  null $parameters
     * @param  bool $master
     * @return array
     */
    public static function findOne($parameters = null, $master = false)
    {
        $result = static::customFind($parameters, $master)->fetch();

        return !empty($result) ? $result : [];
    }

    /**
     * 多条数据查询
     *
     * @param  null $parameters
     * @param  bool $master
     * @return array
     *
     * 使用示例
     *  $parameters = [
            'conditions' => 'pid != :pid: and status = 1',
     *      'bind' => ['pid' = 1]
            'columns'    => 'cname',
        ];
    $res = OpenCityModel::findAll($parameters);
     */
    public static function findAll($parameters = null, $master = false)
    {
        $result = static::customFind($parameters, $master)->fetchAll();

        return !empty($result) ? $result : [];
    }

    /**
     * 数据总数
     *
     * @param  null $parameters
     * @param  bool $master
     * @return int
     */
    public static function total($parameters = null, $master = false)
    {
        $parameters['columns'] = 'count(1) as total';
        $total = static::customFind($parameters, $master)->fetch()['total'];

        return (int)$total;
    }

    /**
     * 字段最大值
     *
     * @param  null $parameters
     * @param  bool $master
     * @return int
     */
    public static function maxmum($parameters = null, $master = false)
    {
        $parameters['columns'] = "max({$parameters['columns']}) as num";
        $maxnum = static::customFind($parameters, $master)->fetch()['num'];

        return (int)$maxnum;
    }

    /**
     * 字段最小值
     *
     * @param  null $parameters
     * @param  bool $master
     * @return int
     */
    public static function minmum($parameters = null, $master = false)
    {
        $parameters['columns'] = "min({$parameters['columns']}) as num";
        $minnum = static::customFind($parameters, $master)->fetch()['num'];

        return (int)$minnum;
    }


    /**
     * 批量更新某个字段的值  可以指定多个where 条件
     * @param $update_data
     * @param string $set_column
     * @param string $where_column
     * @return bool
     * @author liuaifeng@szy.cn
     *
     * 使用示例:
     * $res = MerchantStoreModel::batchUpdateColumn($update_poids,'is_deleted','tp_store_id');
     */
    public static function batchUpdateColumn($update_data, $set_column = 'ad_code', $where_column = 'id')
    {
        if(empty($update_data)){
            LogHelper::error('batch_update_error','params is null.');
            return false;
        }
        /*$display_order = [
            条件 => 修改后的值
            1 => 4,
            2 => 1,
        ];*/
        $model = new static();
        $table = $model->getSource();

        $ids = implode(',', array_keys($update_data));
        $sql = "UPDATE {$table} SET {$set_column} = CASE {$where_column} ";
        foreach ($update_data as $id => $value) {
            $sql .= sprintf("WHEN %d THEN %d ", $id, $value);
        }
        $sql .= "END WHERE {$where_column} IN ($ids)";
        //var_dump($sql);
        LogHelper::logic('batch_update_error_sql',$sql);


        $db =  di($model->getDbName());
        if (!$db->execute($sql) || $db->affectedRows() < 1) {
            $error_log = [
                'db'           => $model->getDbName(),
                'table'        => $table,
                'set_column'   => $set_column,
                'where_column' => $where_column,
                'sql'          => $sql
            ];
            LogHelper::error('batch_update_error', $error_log);
            //批量更新失败
            return false;
        }
        return true;
    }
}
