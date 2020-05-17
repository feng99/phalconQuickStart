<?php
/**
 * redis key常量定义
 */

namespace App\Sdks\Constants\Base;

class RedisKey
{

    //后台登陆账号限制
    const UC_LOGIN_ACCOUNT_LOCK      = 'uc_login_account_lock:%s';

    //文章浏览数
    const POST_VIEW_NUM             = "article_view_num|article_id:%s";

    //文章点赞数
    const POST_LIKE_NUM             = "article_like_num|article_id:%s";

    //文章分享数
    const POST_SHARE_NUM            = "article_share_num|article_id:%s";

    //文章评论总数
    const POST_COMMENT_NUM          = "article_comment_num|article_id:%s";

    /**
     * 配置
     *
     * @var array
     */
    public static $SETTINGS = [
        'App\Sdks\Services\UserService::getUserInfo'          => [
            'expire_time' => 86400,
            'custom_key'  => 'userInfo'
        ],




    ];

    /**
     * 获取过期时间
     *
     * @param $redis_key
     * @return int
     */
    public static function expire($redis_key = '')
    {
        //default expire time is 1 hours
        $time = 3600;

        if ($redis_key && isset(self::$SETTINGS[$redis_key]['expire_time'])) {
            $time = self::$SETTINGS[$redis_key]['expire_time'];
        }
        return $time;
    }


}
