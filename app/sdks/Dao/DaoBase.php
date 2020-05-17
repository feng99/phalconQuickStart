<?php
/**
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


class DaoBase extends Models\Base\ModelBase
{

}