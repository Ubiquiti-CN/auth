<?php

//-----------------------------------UniFi----------------------------------------------------
/* UniFi 配置 */
define('UNIFI_SERVER', '');
define('UNIFI_USER', '');
define('UNIFI_PASSWORD', '');
//-----------------------------------UniFi----------------------------------------------------

//-----------------------------------系统配置（不要修改）-----------------------------------------
define('ROOT_PATH', dirname(__FILE__));
define('DEPS_PATH', ROOT_PATH . '/deps');
define('SITES_PATH', ROOT_PATH . '/s');
define('SDK_PATH', ROOT_PATH . '/sdk');
define('WEIXIN_PATH', SDK_PATH . '/weixin');
define('WEIBO_PATH', SDK_PATH . '/weibo');
/* cookie 存放路径 */
define('COOKIE_FILE_PATH', ROOT_PATH . '/tmp/unifi_cookie');

//UniFi 微信和验证码授权上网配置信息
define('CONFIG_PATH', ROOT_PATH . '/config');

include_once (DEPS_PATH . '/VerifyCode.php');
include_once (DEPS_PATH . '/unifi.php');
include_once (DEPS_PATH . '/get_site.php');

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