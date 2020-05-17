<?php

namespace App\Sdks\Core\System\Db;

use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Db\Profiler;
use Phalcon\Logger;

/**
 * mysql适配器
 */
class CustomMysql
{
    /**
     * 数据库超时重连次数
     *
     * @var int
     */
    protected $retry_times = 5;

    protected $_profiler;

    protected $_logger;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->_profiler = DiHelper::getShared('profiler');
    }

    /**
     * 如果事件触发器是'beforeQuery'，此函数将会被执行
     */
    public function beforeQuery($event, $connection)
    {
        //记录sql
        $this->setProfile($event, $connection);

        $i = 0;
        do {
            try {
                // 注：重连后PDO对象已经重新生成
                $pdo = $connection->getInternalHandler();
                @$pdo->getAttribute(\PDO::ATTR_SERVER_INFO);
            } catch (\PDOException $e) {
                // 获取错误信息并记录
                $error_code = (int)$e->errorInfo[1];
                $error_msg  = $e->errorInfo[2];
                //LogHelper::error('mysql.error.log', "Before Query Error: [{$error_code}] {$error_msg}");

                // 重连数据库
                if (in_array($error_code, [2006, 2013])) {
                    $connection->connect();
                    $i++;
                   // LogHelper::error('mysql.error.log', "重试次数：$i");
                    continue;
                }
            }
            break;
        } while ($i < $this->retry_times);
    }

    /**
     * 如果事件触发器是'afterQuery'，此函数将会被执行
     * @param $event
     * @param $connection
     */
    public function afterQuery($event, $connection)
    {
        $this->setProfile($event, $connection);

        $this->explainSql($connection);
    }

    /**
     * 记录执行sql
     *
     * @param $event
     * @param $connection
     */
    protected function setProfile($event, $connection)
    {
        //一条语句查询之前事件，profiler开始记录sql语句
        if ($event->getType() == 'beforeQuery') {
            //写日志
            //LogHelper::logic('test_mysql.log', $connection->getSQLStatement());
            $this->_profiler->startProfile($connection->getSQLStatement());

            //echo $connection->getSQLStatement();
        }
        //一条语句查询结束，结束本次记录，记录结果会保存在profiler对象中
        if ($event->getType() == 'afterQuery') {
            $this->_profiler->stopProfile();
        }
    }

    /**
     * explain分析非正式环境的select sql语句
     * @param $connection
     */
    public function explainSql($connection)
    {
        return ;
        if (CommonHelper::isPro()) {
            return;
        }

        try{
            $sql = $connection->getRealSQLStatement();
            //get params
            $pdo = $connection->getInternalHandler();
            if (mb_stripos(" " .$sql, "select") && !mb_stripos(" " .$sql, "INFORMATION_SCHEMA") ) {
                $where   = $connection->getSqlVariables();
                $exp_sql = "EXPLAIN " . $sql;
                //$sth =  $pdo->prepare($exp_sql);
                if(count($where) > 0){
                    //pdo param bind
                    /*foreach($where as $k => $v){
                        $type = is_numeric($v) ? $pdo::PARAM_INT : $pdo::PARAM_STR;
                        $sth->bindValue(':'.$k, $v,$type) ;
                    }*/

                    //str_replace param
                    foreach($where as $k => $v){
                        $prefix = strpos(' '.$k,':') === false ? ':' : '' ;
                        if(!is_array($v)){
                            $exp_sql = is_numeric($v) ? str_replace($prefix.$k,$v,$exp_sql) : str_replace($prefix.$k,"'".$v."'",$exp_sql);
                        }else{
                            foreach($v as $kn => $vn){
                                $exp_sql = str_replace($prefix.$k.$kn,"'".$vn."'",$exp_sql);
                            }
                        }
                    }
                }
                $sth =  $pdo->prepare($exp_sql);

                $sth->execute();
                $explain = $sth->fetchAll();
                if(is_array($explain)){
                    if(isset($explain[0]['type'])){
                        if($explain[0]['type'] == 'all' || $explain[0]['type'] == 'ALL' ||  $explain[0]['key'] == NULL){
                            //LogHelper::debug("question_sql",$exp_sql);
                        }
                    }
                }
            }
        }catch (\PDOException $e){
            $error_msg  = $e->errorInfo;
            LogHelper::warning(" explain_pdo",$error_msg);
        }
    }

}