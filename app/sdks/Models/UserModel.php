<?php

namespace App\Sdks\Models;

use App\Sdks\Dao\DaoBase;

/**
 * 用户实体
 * 对Table的映射
 * 禁止封装其他函数
 */
class UserModel extends DaoBase
{
    public $id;
    public $name;

    public function getSource()
    {
        return "t_users";
    }

    public function initialize()
    {
        parent::initialize();
        $this->skipAttributes(array('create_time'));
        $this->useDynamicUpdate(true);

    }


}
