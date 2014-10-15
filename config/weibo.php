<?php
//-----------------------------------服务器配置-------------------------------------------------
define('SERVER_HOST', '');
//-----------------------------------服务器配置-------------------------------------------------

//-----------------------------------UniFi----------------------------------------------------
/* wifi有效时间 */
define('WIFI_EXPIRED_TIME', 60);//分钟
//-----------------------------------UniFi----------------------------------------------------

/* 默认跳转页面 */
define('DEFAULT_URL', 'http://www.ubnt.com.cn');

//-----------------------------------微博------------------------------------------------------
define('WEIBO_AKEY', '');
define('WEIBO_SKEY', '');
define('WEIBO_CALLBACK_URL', '');
define('WEIBO_NAME', '');
define('WEIBO_MESSAGE', '');
define('WEIBO_SEND_ERROR_MESSAGE', '');
define('WEIBO_FOLLOW_ERROR_MESSAGE', '');
//-----------------------------------微博------------------------------------------------------

//-----------------------------------MySQL----------------------------------------------------
/* 配置mysql */
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');//数据库密码
define('DB_DBNAME', '');//数据库库名
define('DB_PORT', '3306');

define('WEIXIN_TABLE', '');//微信表名
define('VERIFY_CODE_TABLE', '');//验证码表名
//-----------------------------------MySQL----------------------------------------------------

$config = array(
    'host' => DB_HOST,
    'user' => DB_USERNAME,
    'pass' => DB_PASSWORD,
    'name' => DB_DBNAME,
    'port' => DB_PORT,
);
$mysql = new UbntMysql($config);