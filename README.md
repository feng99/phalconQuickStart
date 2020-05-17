[TOC]

# phalcon_demo

基于phalcon3.2封装的demo项目

# 环境要求
- php7.0及以上
- phalcon3.2.4及以上
- redis扩展
- mongodb扩展



# 介绍

## 分层结构

```
 控制器层(Controller) 调用服务层
 服务层(Service)      数据操作层(可调用多个Dao)
 数据操作层(Dao)      调用实体层 封装操作DB的函数
 实体层(Model)        无调用,DB TABLE的映射
 视图层(View)         前后端分离,后端只提供API接口,视图层失去了原有的作用
```

### 使用规范:

1.禁止跨层调用

2.各层保持职责单一性 

如Service层  只做数据校验, 数据调用,数据封装    禁止封装数据操作逻辑,这是Dao层应该做的事情. 

3.缓存封装在Dao层      由Service层调用Dao层时使用   

## 配置文件  

### 支持多环境 dev/test/rc/pro

默认配置在default_config.php中.	

> mysql.php
>
> redis.php
>
> beanstalk.php
>
> elastic.php
>
> session.php
>
> logic.php
>
> mail.php
>
> system.php
>
> mongodb.php

### 敏感配置与公开配置与代码隔离,保证安全

在机器的/data/app_config/application.ini文件中,

存放如 access_key/secret密钥  第三方SDK帐号 密码等信息  

## 日志存储 使用SeasLog 高性能日志组件 

> 具体请看 LogHelper.php

## Beanstalk 队列操作封装

> 任务生产者 按照不同的业务进行配置化管理
>
> 任务消费者单独开启进程  使用supervisor进程管理器维护.
>
> 

具体请看

1.QueueService.php

2.QueueTube.php

3.QueueTaskConfig.php



## Redis内存锁

具体请看LockManager

此部分参考https://github.com/hormoneGroup/memory-lock实现

删掉了Memcache内存锁,只使用Redis内存锁, 

删掉了Lock  Interface定义  让结构更简单.

```
  使用示例:
  try {
  	$redis = DiHelper::getSharedRedis();
  	LockManager::init($redis);
  	//获取锁
  	LockManager::lock($key);
  	
  	//todo 业务逻辑
  } catch (\Exception $e) {
    // todo Exception

  } finally {
     //释放锁
  	LockManager::unlock($key);
   }
 
```





## 计数器功能

### 实现原理

1. 使用redis的incr原子命令实现

2. 读取都是先操作Redis中,然后再同步到Mysql中

3. 支持在配置文件中统一管理,请看CounterConfig.php

4. 具体代码请看 CounterService.php



### 使用场景

1.计数器

> 文章/动态的pv uv
>
> 文章的被评论数/被点赞数/被转发数 等等 

2.限速器

> 本质上还是根据计数来实现,比如 限制某个api每秒每个ip的请求次数不超过10次
>
> 限速器 建议配合nginx lua脚本使用  这里仅作讨论

>

> 
>
>   文章/动态/评论的pv uv   统计数据
>
> 
>
> 

## 缓存功能统一封装 

### 封装函数

1. #### 从缓存中获取数据FromCache()   

2. #### 删除缓存数据DelCache()

3. #### 重置缓存数据ResetCache

请看CacheTraits.php和RedisKey.php

缓存封装在Dao层      由Service层调用Dao层时使用   

例子 

```
以下为伪代码

UserDao userDao = new UserDao();

//不使用缓存
$userInfo = userDao->getUserInfoByUid($uid);
return $userInfo;


//传统方式使用缓存
//1.查询缓存 2.缓存里有数据,直接返回 3.缓存里没有数据,则先查询DB,再存入缓存
//这样的逻辑  估计你写了几百遍了
$redis = new Redis();
$userInfo = $redis->get($uid);
if(null == $cacheUserInfo){
	$userInfo = userDao->getUserInfoByUid($uid);
	$redis->setex($userInfo,600);
}
return $userInfo;


//新的方式, 是不是很方便? 
//时间默认为7200秒,如果想自定义key 和过期时间 请看RedisKey.php
$userInfo = userDao->getUserInfoByUidFromCache($uid);
return $userInfo;

注意这个FromCache
删除缓存数据使用 DelCache
实现原理是魔术方法__call()函数, 当调用不存在的函数时,会自动调用这个函数.




```



### 实体类函数封装

```
 1.根据主键id查询单个对象getEntityById($id)
 2.根据指定字段查询单个对象getEntityByCustomField($id)
 3.根据主键id或者自定义字段 进行in查询   
 支持传递数组, 建议控制在100个以内,且建立索引
 getEntityById([1,2,3])
 getEntityByCustomField([1,2,3])
```



# composer.json

```
{
    "minimum-stability": "dev",
    "prefer-stable": true,
    "require": {
        "illuminate/database": ">=4.0.9,<4.2",
        "guzzlehttp/guzzle":"6.*",
        "qiniu/php-sdk": "7.*",
        "ashleydawson/simple-pagination": "~1.0",
        "elasticsearch/elasticsearch": "~2.0",
        "filp/whoops": "^1.1.6",
        "clickalicious/phpmemadmin": "~0.3",
        "mockery/mockery": "1.0.*@dev",
        "phpunit/phpunit": "~4.5",
        "endroid/qrcode": "^1.5",
        "overtrue/wechat": "^2.1",
        "pbweb/xhprof": "^1.0",
        "phpoffice/phpexcel": "^1.8",
        "springshine/getui-sdk": "^1.1",
        "pda/pheanstalk": "^3.1",
        "phalcon/devtools": "~3.2",
        "inhere/php-validate": "dev-master",
        "mongodb/mongodb": "^1.2",
        "swiftmailer/swiftmailer": "^6.0"
    },
    "scripts": {
        "post-install-cmd": [
            "Clickalicious\\PhpMemAdmin\\Installer::postInstall"
        ]
    },
    "config": {
        "secure-http": false
    },
    "repositories": {
        "packagist": {
            "type": "composer",
            "url": "https://packagist.phpcomposer.com"
        }
    }
}

```

# phalconV3.4中文文档

https://www.kancloud.cn/jaya1992/phalcon_doc_zh/

# 其他

## Phalcon\Security\Random 随机内容生成类

```
Phalcon\Security\Random类生成生成许多类型的随机数据变得非常容易	
<?php

use Phalcon\Security\Random;

$random = new Random();

// ...
$bytes      = $random->bytes();

// 随机生成一个长度为$length的十六进制字符串
$hex        = $random->hex($length);

// 随机生成长度为$length的base64字符串
$base64     = $random->base64($length);

// 生产一个长度为$length的安全base64字符串.
$base64Safe = $random->base64Safe($length);

// 生成一个UUId
// See https://en.wikipedia.org/wiki/Universally_unique_identifier
$uuid       = $random->uuid();

//生成一个0-N之间的随机数字
//可用于redis key加随机数,防止缓存雪崩问题
$number     = $random->number($n);
```

### 生成密码

```
$security = \App\Sdks\Library\Helpers\DiHelper::getShared("security");
//生成密码
security->generatePassword("明文密码");
//校验密码 
security->checkPassword($password, $password_hash);
```

