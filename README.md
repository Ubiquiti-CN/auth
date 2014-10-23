UniFi 微信、微博、QQ和验证码授权上网代码
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

3.下载代码

+ 方法一：直接下载[代码](https://github.com/Ubiquiti-cn/auth/archive/master.zip)，重命名为guest，放到/home/wwwroot/目录下
+ 方法二：git clone https://github.com/Ubiquiti-cn/auth.git /home/wwwroot/guest

###代码配置
1.配置config/_global.php文件

    //-----------------------------------UniFi----------------------------------------------------
    define('UNIFI_SERVER', 'https://x.x.x.x:8443');
    define('UNIFI_USER', 'username');
    define('UNIFI_PASSWORD', 'password');
    //-----------------------------------UniFi----------------------------------------------------

    //-----------------------------------MySQL----------------------------------------------------
    define('DB_HOST', 'localhost');//数据库HOST
    define('DB_USERNAME', 'username');//数据库用户名
    define('DB_PASSWORD', 'password');//数据库密码
    define('DB_DBNAME', 'unifi');//数据库库名
    define('DB_PORT', '3306');//数据库端口
    //-----------------------------------MySQL----------------------------------------------------

2.新建名为unifi的数据库，并在unifi下创建表

    create database `unifi`;

    CREATE TABLE `weixinTest` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `Mac_ID` varchar(20) NOT NULL,
       `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
       `fromUserName` varchar(255) NOT NULL,
       PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    CREATE TABLE `verify_code` (
     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
     `Mac_ID` varchar(20) CHARACTER SET utf8 NOT NULL,
     `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    create table `auth_type` (
     `id` int unsigned PRIMARY KEY auto_increment,
     `auth_name` varchar(50) not null DEFAULT ''
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    create table `site` (
     `id` INT unsigned PRIMARY KEY auto_increment,
     `auth_id` varchar(200) not NULL DEFAULT '',
     `site_name` VARCHAR(50) NOT NULL DEFAULT ''
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    CREATE TABLE `config` (
     `id` INT unsigned PRIMARY KEY auto_increment,
     `site_id` INT unsigned NOT NULL DEFAULT 0,
     `auth_id` INT unsigned NOT NULL DEFAULT 0,
     `content` text not NULL DEFAULT ''
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    
3.config下配置需要的portal类型（微信、微博、QQ、验证码）


###常见问题
1.如一直授权失败，可能是tmp/unifi_cookie文件没有权限。可以改成777再试一下