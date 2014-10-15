<?php

//UniFi 微信和验证码授权上网配置信息

//-----------------------------------服务器配置-------------------------------------------------
define('SERVER_HOST', '');
//-----------------------------------服务器配置-------------------------------------------------

//-----------------------------------UniFi----------------------------------------------------
/* UniFi 配置 */
define('UNIFI_SERVER', '');
define('UNIFI_USER', '');
define('UNIFI_PASSWORD', '');

/* wifi有效时间 */
define('WIFI_EXPIRED_TIME', 60);//分钟
//-----------------------------------UniFi----------------------------------------------------

//-----------------------------------微信------------------------------------------------------
/* 默认跳转页面 */
define('DEFAULT_URL', 'http://www.ubnt.com.cn');

/* 微信 开发者中心->服务器配置 Token值 */
define('WECHAT_TOKEN', '');
define('WECHAT_APPID', '');
define('WECHAT_APPSECRET', '');

/* 微信消息和欢迎内容 */
define('WEIXIN_AUTH_MESSAGE', '');//当用户发送此内容才能获取返回
define('WEIXIN_ADD_WELCOME_MESSAGE', '');//关注后的欢迎内容
//-----------------------------------微信------------------------------------------------------

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




//-----------------------------------系统配置（不要修改）-----------------------------------------
define('ROOT_PATH', dirname(__FILE__));
define('DEPS_PATH', ROOT_PATH . '/deps');
define('SITES_PATH', ROOT_PATH . '/s');
define('SDK_PATH', ROOT_PATH . '/sdk');
define('WEIXIN_PATH', SDK_PATH . '/weixin');
define('WEIBO_PATH', SDK_PATH . '/weibo');
/* cookie 存放路径 */
define('COOKIE_FILE_PATH', ROOT_PATH . '/tmp/unifi_cookie');

include_once (DEPS_PATH . '/VerifyCode.php');
include_once (DEPS_PATH . '/unifi.php');

include_once (DEPS_PATH . '/mysql.php');
$config = array(
    'host' => DB_HOST,
    'user' => DB_USERNAME,
    'pass' => DB_PASSWORD,
    'name' => DB_DBNAME,
    'port' => DB_PORT,
);
$mysql = new UbntMysql($config);
//-----------------------------------系统配置（不要修改）-----------------------------------------