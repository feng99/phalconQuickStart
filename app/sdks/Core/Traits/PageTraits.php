<?php

namespace App\Sdks\Core\Traits;

use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Di;

/**
 * 分页类库
 */
trait PageTraits
{
    /**
     * 获取分页参数
     *
     * @param  array  $params
     *
     * @return array
     */
    public static function getPageArgs(array $params): array
    {
        $defaultPageSize = DiHelper::getConfig()->application->default_page_size;

        $page       = isset($params['page']) ? intval($params['page']) : 1;
        $pageSize   = isset($params['pageSize']) ? intval($params['pageSize']) : $defaultPageSize;

        if ($pageSize < 1) {
            $pageSize = $defaultPageSize;
        }

        if ($page < 1) {
            $page = 1;
        }

        $start = ($page - 1) * $pageSize;

        return [
            'page'      => $page,
            'pageSize'  => $pageSize,
            'start'     => $start,
        ];
    }


    /**
     * 设置分页条件 [phalcon model param]
     *
     * @param $condition
     * @param array $pageArgs
     * @return array
     */
    public static function setConditionLimit(&$condition, $pageArgs = [])
    {
        $page = self::getPageArgs($pageArgs);
        $page = array_merge($page, $pageArgs);
        $condition['offset'] = $page['start'];
        $condition['limit'] = $page['pageSize'];
        return $condition;
    }

    /**
     * 输出分页结构体
     *
     * @param   int   $total
     * @param   array $data
     * @param   array $pageArgs
     * @return  array
     */
    public static function flashPageData(int $total, array $data, array $pageArgs = [])
    {
        return [
            // 总数
            'total'      => $total,
            // 分页数
            'page_count' => ceil($total / $pageArgs['pageSize']),
            // 当前页码数
            'page'   => $pageArgs['page'],
            // 展示最大分页数量
            'pageSize'  => $pageArgs['pageSize'],
            // 数据
            'data'       => $data,
        ];
    }
}