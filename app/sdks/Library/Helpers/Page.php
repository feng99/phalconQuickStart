<?php
/**
 * 分页助手
 *
 * @package   App\Sdks\Library\Traits
 */

namespace App\Sdks\Library\Helpers;



trait Page
{

    /**
     * 获取后台列表分页参数
     *
     * @param $param
     * @return array
     */
    public static function getPageArgs($param = [])
    {
        $default_page_size = \Phalcon\Di::getDefault()->getShared('config')->logic->default_page_size;

        if (!$param) {
            $request   = \Phalcon\Di::getDefault()->getShared('request');
            $page_num  = $request->get('page_num', 'int', 1);
            $page_size = $request->get('page_size', 'int', $default_page_size);
        } else {
            $page_num  = isset($param['page_num']) ? intval($param['page_num']) : 1;
            $page_size = isset($param['page_size']) ? intval($param['page_size']) : $default_page_size;
        }

        if ($page_size < 1) {
            $page_size = $default_page_size;
        }

        if ($page_num < 1) {
            $page_num = 1;
        }

        $start = ($page_num - 1) * $page_size;

        return [
            'page_num'  => $page_num,
            'page_size' => $page_size,
            'start'     => $start,
        ];
    }

    /**
     * 设置分页条件 [phalcon model param]
     *
     * @param $condition
     * @return array
     */
    public static function setConditionLimit(&$condition, $pageArgs = [])
    {
        $page                = self::getPageArgs($pageArgs);
        $page                = array_merge($page, $pageArgs);
        $condition['offset'] = $page['start'];
        $condition['limit']  = $page['page_size'];
        return $condition;
    }

    /**
     * 输出分页结构体
     *
     * @param $total
     * @param $data
     * @return array
     */
    public static function flashPageData($total = 0, $data = [], $pageArgs = [])
    {
        $page = self::getPageArgs();
        $page = array_merge($page, $pageArgs);

        //返回数据格式
        $return_data = [
            'total'      => $total, //总数
            'page_count' => ceil($total / $page['page_size']), //分页数
            'page_num'   => $page['page_num'], //当前页码数
            'page_size'  => $page['page_size'], //展示最大分页数量
            'data'       => $data, //数据
        ];
        return $return_data;
    }

    /**
     * 获取分页挂件数据
     *
     * @param  array   $ret
     * @param  string  $uri
     * @return array
     */
    public static function getPageWidget(array $ret, $uri = null)
    {
        $page_html = '';
        if ($ret['page_count'] > 1) {
            $request = \Phalcon\Di::getDefault()->getShared('request');
            $page    = $request->get('page_num', 'int', 1);

            $uri = $uri ? : $request->getURI();

            $page_html .= '<div class="page_margin">';
            $page_html .= '<ul class="pagination ">';

            $lis_class = $page <= 1 ? 'disabled' : '';
            $lis_url   = CommonHelper::getStatActUrl($uri, ['page_num' => ($page > 1 ? $page - 1 : $page)]);
            $page_html .= "<li class=\"{$lis_class}\"><a href=\"{$lis_url}\">&laquo;</a></li>";
            for ($i = 1; $i <= $ret['page_count']; $i++) {
                $for_class  = $page == $i ? 'active' : '';
                $li_href    = CommonHelper::getStatActUrl($uri, ['page_num' => $i]);
                $page_html .= "<li class=\"{$for_class}\"><a href=\"{$li_href}\">{$i}</a></li>";
            }
            $lie_class = $page >= $ret['page_count'] ? 'disabled' : '';
            $lie_url   = CommonHelper::getStatActUrl($uri, ['page_num' => $ret['page_count']]);
            $page_html .= "<li class=\"{$lie_class}\"><a href=\"{$lie_url}\">&raquo;</a></li>";
            $page_html .= '</ul>';
            $page_html .= '</div>';
        }
        $ret['page_html'] = $page_html;

        return $ret;
    }

}