UniFi 微信、微博和验证码授权上网代码
===========

###测试通过的controller版本
    v.3.2.1
    v.3.2.5

###微信配置和Controller配置
请参照[优倍快技术论坛](http://bbs.ubnt.com.cn/forum.php?mod=viewthread&tid=9914&page=1)

###微博配置和Controller配置
请参照[优倍快技术论坛](http://bbs.ubnt.com.cn/forum.php?mod=viewthread&tid=9510)

###服务器配置（本教程针对Linux服务器）
1.需要一台有公网固定ip的服务器

2.搭建LNMP（Linux+Nginx+MySQL+PHP）环境，可参照[lnmp](http://lnmp.org/install.html)
+ PHP需安装curl插件

3.下载本次案例代码，将auth重命名为guest，放到/home/wwwroot/目录下

###代码配置
1.配置config/_global.php文件
    /* UniFi 配置 */
    define('UNIFI_SERVER', 'https://1.1.1.1:8443');
    define('UNIFI_USER', 'username');
    define('UNIFI_PASSWORD', 'password');

2.配置config/weixin.php文件（微博配置config/weibo.php）
    //-----------------------------------服务器配置-------------------------------------------------
    define('SERVER_HOST', 'http://1.1.1.1');
    //-----------------------------------服务器配置-------------------------------------------------
    
    //-----------------------------------UniFi----------------------------------------------------
    /* wifi有效时间 */
    define('WIFI_EXPIRED_TIME', 60);//分钟
    //-----------------------------------UniFi----------------------------------------------------
    
    /* 默认跳转页面 */
    define('DEFAULT_URL', 'http://www.ubnt.com.cn');
    
    //-----------------------------------微信------------------------------------------------------
    /* 微信 开发者中心->服务器配置 Token值 */
    define('WECHAT_TOKEN', 'test');
    /* 是否加密 */
    define('WECHAT_ENCODING_ENABLE', false);
    /* 加密用的EncodingAESKey */
    define('WECHAT_ENCODING_AES_KEY', '');
    /* 高级调用功能的app id */
    define('WECHAT_APP_ID', '');
    /* 高级调用功能的app secret */
    define('WECHAT_APP_SECRET', '');
    
    /* 微信消息和欢迎内容 */
    define('WEIXIN_AUTH_MESSAGE', '我要上网');//当用户发送此内容才能获取返回
    define('WEIXIN_WELCOME_MESSAGE', '您好');//关注后的欢迎内容
    //-----------------------------------微信------------------------------------------------------
    
    //-----------------------------------MySQL----------------------------------------------------
    /* 配置mysql */
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'password');//数据库密码
    define('DB_DBNAME', 'unifi');//数据库库名
    define('DB_PORT', '3306');
    
    define('WEIXIN_TABLE', 'weixinTable');//微信表名
    //-----------------------------------MySQL----------------------------------------------------


3.数据库配置。新建名为DB_DBNAME的数据库，执行一下sql语句建表

    CREATE TABLE `weixinTable` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `Mac_ID` varchar(20) NOT NULL,
     `site` varchar(100) CHARACTER SET utf8 NOT NULL,
     `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `fromUserName` varchar(255) NOT NULL,
     `ticket` varchar(255) CHARACTER SET utf8 NOT NULL,
     PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    
    CREATE TABLE IF NOT EXISTS `verify_code` (
     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
     `Mac_ID` varchar(20) CHARACTER SET utf8 NOT NULL,
     `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;


###常见问题
1.如一直授权失败，可能是tmp/unifi_cookie文件没有权限。可以改成777再试一下
