<?php
/**
 * 计数器配置
 */

namespace App\Sdks\Constants\Base;

class CounterConfig
{

    /**
     * like操作
     */
    const LIKE = 1;

    /**
     * follow操作
     */
    const FOLLOW = 2;

    /**
     * 浏览
     */
    const VIEW = 3;


    /**
     * 评论
     */
    const COMMENT = 4;


    /**
     * 经验值
     */
    const EXP = 5;

    /**
     * 分享
     */
    const SHARE = 6;


    /**
     * 粉丝数量计数器
     */
    const USER_FANS_NUM = 7;



    /**
     * 设置
     *
     * 参数说明：
     * key:         Redis中的key
     * step:        每次操作增加的数量，默认为1
     * persistence: 积累多少条进行持久化
     * init_func:   初始化调用的回调函数  当缓存过期时,自动调用
     * update_func: 数据持久化的回调函数  更新mysql的值
     *
     * @var array
     */
    public static $SETTINGS = [
        self::VIEW                => [
            /**
             * 帖子浏览数
             */
            ContentType::POST        => [
                'key'         => RedisKey::POST_VIEW_NUM,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\PostService::getViewNum',
                'update_func' => '\App\Sdks\Services\PostService::updateViewNum',
            ],

            /**
             * 小秘书文章浏览数
             */
            /*ContentType::MSG_ARTICLE => [
                'key'         => RedisKey::MSG_ARTICLE_VIEW_NUM,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\ZtMessagesService::getViewNum',
                'update_func' => '\App\Sdks\Services\ZtMessagesService::updateViewNum',
            ],*/

        ],
        //帖子评论
        self::COMMENT             => [
            //添加
            ContentType::POST => [
                'key'         => RedisKey::POST_COMMENT_NUM,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\CommentService::getPostCommentNum',
                'update_func' => '\App\Sdks\Services\PostService::updateCommentNum',
            ],
        ],
        // 点赞
        self::LIKE                => [
            // 帖子点赞数
            ContentType::POST => [
                'key'         => RedisKey::POST_LIKE_NUM,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\PostService::getLikeNum',
                'update_func' => '\App\Sdks\Services\PostService::updateLikeNum',
            ],
            //评论 点赞数
            ContentType::COMMENT => [
                'key'         => RedisKey::COMMENT_LIKE_NUM,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\CommentService::initLikeNum',
                'update_func' => '',
            ],
        ],
        // 分享
        self::SHARE               => [
            // 帖子
            ContentType::POST => [
                'key'         => RedisKey::POST_SHARE_NUM,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\PostService::getShareNum',
                'update_func' => '\App\Sdks\Services\PostService::updateShareNum',
            ],
        ],

        self::USER_FANS_NUM    => [
            ContentType::USER => [
                'key'         => RedisKey::USER_FANS_COUNT,
                'step'        => 1,
                'persistence' => 1,
                'init_func'   => '\App\Sdks\Services\FollowService::getFansNum',
                'update_func' => '',
            ],
        ],
    ];
} 