<?php

namespace App\Sdks\Models\Base;

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
     * 使用DB连接名称
     *
     * @var string
     */
    protected $db_name = 'db';


    /**
     * 初始化时执行
     */
    public function initialize()
    {
        Model::setup(['notNullValidations' => false]);
    }

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
     * 返回一个数组
     * @param null $parameters
     * @return array|Model
     */
    public static function findFirstArray($parameters = null)
    {
        $model = new static();
        $result  = $model::findFirst($parameters);
        return !empty($result) ? $result : [];
    }


    /**
     * 批量添加
     *
     * @param array $data 二维数组
     * @param bool $replace
     * @param bool $ignore
     * @param string $tableName
     * @param string $duplicate_update  field_name = VALUES(field_name)
     * @return mixed
     * @throws \Exception
     */
    public function saveAll($data, $replace = false, $ignore = false, $tableName = '',$duplicate_update = '')
    {
        if (empty($tableName)) {
            $tableName = $this->getSource();
        }
        if ($replace) {
            $sql = "REPLACE";
        } else {
            $sql = !$ignore ? "INSERT" : "INSERT IGNORE";
        }

        $update = '';
        if($sql == 'INSERT' && $duplicate_update != ''){
            $update = sprintf(" ON DUPLICATE KEY UPDATE %s",$duplicate_update);
        }

        $data = array_values($data);
        if (!isset($data[0])) {
            throw new \Exception("参数必须是二维数组!");
        }
        $cols = implode(',', array_keys($data[0]));
        $vals = implode(',', array_fill(0, count($data[0]), '?'));
        $vals = ltrim(str_repeat(",({$vals})", count($data)), ',');
        $sql .= " INTO {$tableName} ({$cols}) VALUES {$vals} {$update}";


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
        $result = \Phalcon\Di::getDefault()->getShared($model->getDbName())->query($sql, $columns['bind']);
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        return $result;
    }


    /**
     * 设置DB名称
     *
     * @param  $db_name
     * @return void
     */
    public function setDbName($db_name)
    {
        $this->db_name = $db_name;
    }

    /**
     * 获取DB名称
     *
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
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
           'bind' => ['pid' = 1]
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





























    /**
     * 按照条件更新数据
     *
     * @param $data
     * @param $where
     * @return mixed
     * @throws \Exception
     */
    public function execUpdate($data, $where)
    {

        if (empty($where['conditions'])) {
            throw new \RuntimeException("缺少参数 conditions");
        }

        if (preg_match_all("/(:[\w]+):/", $where['conditions'], $match)) {
            $where['conditions'] = str_replace($match[0], $match[1], $where['conditions']);
        }

        $conditions = $where['conditions'];
        $bind = $where['bind'] ?? [];

        $fields = [];
        foreach ($data as $col => $val) {
            $fields[] = "`" . $col . "`=:" . $col;
        }
        $sql = sprintf("UPDATE `%s` SET %s WHERE %s", $this->getSource(), join(',', $fields), $conditions);
        $sth = $this->getWriteConnection()->prepare($sql);

        foreach (array_merge($data, $bind) as $k => $v) {
            $sth->bindValue(":" . trim($k, ":"), $v);
        }

        return $sth->execute();
    }


    /**
     * 按照条件删除数据（物理删除）
     *
     * @param $where
     * @param int $limit 删除条数，默认1，0 为不限制
     * @return mixed
     * @throws \Exception
     */
    public function execDelete($where, $limit = 1)
    {

        if (empty($where['conditions'])) {
            throw new \Exception("缺少参数 conditions");
        }

        if (preg_match_all("/(:[\w]+):/", $where['conditions'], $match)) {
            $where['conditions'] = str_replace($match[0], $match[1], $where['conditions']);
        }

        $conditions = $where['conditions'];
        $bind = isset($where['bind']) ? $where['bind'] : [];

        $sql = sprintf("DELETE FROM `%s` WHERE %s", $this->getSource(), $conditions);
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        $sth = $this->getWriteConnection()->prepare($sql);

        foreach ($bind as $k => $v) {
            $sth->bindValue(":" . trim($k, ":"), $v);
        }

        return $sth->execute();
    }

    /**
     * 批量更新
     *
     * @param $data array   二维数组，并且每个数组的结构必须完全相同
     * @param $where_field  string 二维数组中条件字段名称
     * @return mixed
     * @throws \Exception
     */
    public function batchUpdate($data, $where_field, $extra_where = [])
    {

        if (empty($data[0])) {
            throw new \Exception("参数必须是二维数组并且不能为空");
        }

        if (!isset($data[0][$where_field])) {
            throw new \Exception("指定的条件字段不存在");
        }

        $sql = "UPDATE `{$this->getSource()}` SET ";
        $bind = [];

        if (count($data) > 1) {

            $fields = array_keys($data[0]);
            $where = array_column($data, $where_field);
            $field_data = array_map(null, ...$data);

            $ignore_index = array_search($where_field, $fields);

            foreach ($field_data as $i => $item) {

                if ($i == $ignore_index) continue;

                $sql .= sprintf(" `%s` = CASE `%s` ", $fields[$i], $where_field);
                foreach ($item as $k => $val) {
                    $sql .= " WHEN ? THEN ? ";
                    array_push($bind, $where[$k], $val);
                }
                $sql .= "END,";
            }

            $sql = rtrim($sql, ',') . " WHERE `{$where_field}` IN(" . join(',', array_fill(0, count($where), '?')) . ")";
            $bind = array_merge($bind, $where);

        } else {

            foreach ($data as $item) {

                foreach ($item as $key => $val) {
                    if ($key == $where_field) {
                        continue;
                    }
                    $sql .= sprintf("`%s` = ?,", $key);
                    $bind[] = $val;
                }
            }

            $sql = rtrim($sql, ',') . " WHERE `{$where_field}`=?";
            $bind[] = $data[0][$where_field];
        }

        if (!empty($extra_where['conditions'])) {
            $sql .= " and " . $extra_where['conditions'];
            $bind = array_merge($bind, $extra_where['bind']);
        }

        $sth = $this->getWriteConnection()->prepare($sql);

        foreach ($bind as $i => $v) {
            $sth->bindValue($i + 1, $v);
        }

        return $sth->execute();

    }
}
