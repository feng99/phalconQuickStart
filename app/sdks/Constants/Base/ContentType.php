<?php
/**
 * 对象类型常量类
 */

namespace App\Sdks\Constants\Base;


class ContentType
{
    /**
     * 用户
     */
    const USER              = 101;

    /**
     * 话题
     */
    const TOPIC             = 102;

    /**
     * 帖子/文章
     */
    const POST              = 103;

    /**
     * 评论
     */
    const COMMENT           = 104;





    /**
     * 订单
     */
    const ORDER             = 111;



    /**
     * 通知
     */
    const NOTICE            = 113;


    /**
     * 配置信息
     *
     * @var array
     */
    public static $SETTINGS = [
        self::USER                  => '用户',
        self::TOPIC                 => '话题',
        self::POST                  => '帖子',
        self::COMMENT               => '评论',
        self::FEED                  => 'feed',

    ];


    public static $EDU_RECOMMEND_TYPES = [
        self::POST       =>[
            'id'        => self::POST,
            'name'      => '百科',
        ],
        self::EDU_QUESTION       =>[
            'id'        => self::EDU_QUESTION,
            'name'      => '问答',
        ],
        self::EDU       =>[
            'id'        => self::EDU,
            'name'      => '视听',
        ],
    ];

}
