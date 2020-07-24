# phalconQuickStart

基于phalcon3.4.5封装,帮助你快速启动项目.

# 环境要求
- php7.0及以上
- phalcon3.2.4及以上
- redis扩展

# 功能概览

1.RPC功能封装[yar]
注意:phalcon里无法使用swoole协程功能

2.配置文件 支持多环境  支持敏感配置 物理隔离

3.SeasLog 高性能日志组件

4.Beanstalk 队列操作封装

5.Redis内存锁

6.计数器功能

7.缓存功能统一封装 

8.Task离线任务

9.接口地址支持版本号访问 如 /user/getInfo/v1    /user/getInfo/v2

10.接口请求参数 过滤与校验功能 


# 详细介绍

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

注解


```



### Dao层函数封装

```
  
```

findAll()自定义查询字段与查询条件,查询N个记录

```
使用示例
 $parameters = [
 	   //查询条件
       'conditions' => 'pid != :pid: and status = 1',
       //参数绑定
       'bind' => ['pid' = 1]
       //指定被查询的字段   如果要查询 * 可以不写此条件
       'columns'    => 'cname',
        ];
    $res = OpenCityModel::findAll($parameters);
```





## RPC功能封装[yar+swoole]

> 基于yar 2.1  + swoole 4.4.18版本实现
>
> 支持PHP/JSON/MSGPACK格式
>
> 主要是为了实现 微服务后 跨项目调用进行数据数据传输.

### 主要代码  一共3个文件 

```
rpc.php  入口文件,启动后常驻内存
ApiRpc.php 对外提供rpc接口的类
RpcBase.php 对数据Header与Body的解析


配置信息:
return [
        'bind' => '127.0.0.1:9500',
        //swoole settings
        'settings' => [
            'worker_num'    => 2,
            'daemonize'     => false,
            'user'          => 'www',
            'group'         => 'www'
        ]
];
```



### 服务端启动命令

```
//注意rpc.php文件的路径
/usr/local/php/bin/php /data/web/github/phalcondemo/app/rpc/rpc.php
```

### 服务端编码示例

> 这里就像MVC的控制器入口一样.  可调用service层,dao层代码 操作数据库 操作缓存等.

```
ApiRpc.php中 新增一个函数

	/**
     * 测试函数  接收一个参数
     * @param $id
     */
    public function query($id)
    {
        try{
            $data = [
                1 => ["id"=>1,"name"=>"aaa"],
                2 => ["id"=>2,"name"=>"bbb"],
            ];

            if(!isset($data[$id])){
                throw new \RuntimeException(" id:'{$id}' not found!");
            }
            $this->success($data[$id]);
        }catch (\Exception $e){
            $this->error($e->getMessage(),1200);
        }
    }
    
    
     /**
     * 获取单个用户信息
     * @param $id
     */
    public function getUserInfo($id)
    {
        var_dump("request parameter:",$id);
        try{
            $data = UserService::getUserInfo($id);
            $this->success($data->toArray());
        }catch (\Exception $e){
            $this->error($e->getMessage(),1200);
        }

    }
```





### 客户端调用示例

```
public function testAction()
    {
        try {
        	//注意这里的地址  与上面的配置文件里的信息对应
            $client = new \Yar_Client("tcp://127.0.0.1:9500");
            
            
            //$user = $client->query("1");
            

            //请求单个用户信息
            //$user = $client->getUserInfo("2");
            //var_dump($user);

            //请求多个用户信息
            $user = $client->getUserList(["1","2"]);
            var_dump($user);
        } catch (Exception $e) {
            // 异常处理
        }
    }
```



## Task离线任务

目录:app/tasks

消息队列任务和业务离线数据任务是分开的两个目录

消息队列任务在目录Queue

业务离线数据任务,在目录Task

执行命令

```
php /data/web/keke/miai/app/userserver/app/tasks/cli.php task.uuid run

#队列任务  由supervisor管理
php cli.php queue.sms exec
```





# 更新记录

| 编号 | 优化内容                                                     | 代码所在文件            | 时间       |
| ---- | ------------------------------------------------------------ | ----------------------- | ---------- |
| 1    | 优化获取参数时,getPost()函数 编辑器不提示的问题              | ControllerBase.php      | 2020-06-29 |
| 2    | 优化参数校验  支持单个参数多个校验规则                       | ValidateRouteConfig.php | 2020-06-29 |
| 3    | 删除DaoBase类,用CacheTraits类,减少类之间的继承               | CacheTraits.php         | 2020-06-30 |
| 4    | 优化参数校验模块的目录结构, 只保留BaseFilter  BaseValidate  ValidateRouteConfig文件 | app/sdks/Validate       | 2020-06-30 |
| 5    | 在控制器基类开启跨域支持                                     | ControllerBase          | 2020-07-12 |
| 6    | 在控制器基类 打印所有请求的请求参数  方便调试                | ControllerBase          | 2020-07-15 |
| 7    | 新增PageTraits类  封装统一的分页组件                         | PageTraits              | 2020-07-17 |
| 8    | 新增自定义断言类Assert类,对数据为空和操作失败,进行通知处理,减少if(){{} 代码 | Assert                  | 2020-07-19 |
| 9    |                                                              |                         |            |
| 10   |                                                              |                         |            |



# phalconV3.4中文文档

https://www.kancloud.cn/jaya1992/phalcon_doc_zh/

# 

### 



### 致谢

感谢军哥,杜松,给予的帮助.

