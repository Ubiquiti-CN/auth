<?php

$start_time = microtime(true);

//-----------------------------------系统配置（不要修改）-----------------------------------------
define('PHP_EXT', '.php');
define('ROOT_PATH', dirname(__FILE__));
define('DEPS_PATH', ROOT_PATH . '/deps');
define('SITES_PATH', ROOT_PATH . '/s');
define('SDK_PATH', ROOT_PATH . '/sdk');
define('TMP_PATH', ROOT_PATH . '/tmp');
define('WEIXIN_PATH', SDK_PATH . '/weixin');
define('WEIBO_PATH', SDK_PATH . '/weibo');
/* cookie 存放路径 */
define('COOKIE_FILE_PATH', TMP_PATH . '/unifi_cookie');
/* Browscap cache和ini文件地址 */
define('BROWSCAP_CACHE_FILE', TMP_PATH . '/cache.php');
define('BROWSCAP_CACHE_LOADED', false);

//UniFi 微信和验证码授权上网配置信息
define('CONFIG_PATH', ROOT_PATH . '/config');
include_once (CONFIG_PATH . '/_global' . PHP_EXT);

include_once (DEPS_PATH . '/VerifyCode' . PHP_EXT);
include_once (DEPS_PATH . '/unifi' . PHP_EXT);
include_once (DEPS_PATH . '/get_site' . PHP_EXT);
include_once (DEPS_PATH . '/mysql' . PHP_EXT);
include_once (DEPS_PATH . '/Browscap' . PHP_EXT);

define('USER_AGENT_LOG_TABLE', 'user_agent_log');//user agent log表名
//-----------------------------------系统配置（不要修改）-----------------------------------------