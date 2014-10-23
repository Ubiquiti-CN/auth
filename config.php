<?php

//-----------------------------------系统配置（不要修改）-----------------------------------------
define('PHP_EXT', '.php');
define('ROOT_PATH', __DIR__);
define('DEPS_PATH', ROOT_PATH . '/deps');
define('LIBRARIES_PATH', ROOT_PATH . '/libraries');
define('SITES_PATH', ROOT_PATH . '/s');
define('SDK_PATH', ROOT_PATH . '/sdk');
define('TMP_PATH', ROOT_PATH . '/tmp');

/* SDK 路径 */
define('WEIXIN_PATH', SDK_PATH . '/weixin');
define('WEIBO_PATH', SDK_PATH . '/weibo');
define('QQ_PATH', SDK_PATH . '/qq');

/* cookie 存放路径 */
define('COOKIE_FILE_PATH', TMP_PATH . '/unifi_cookie');

//UniFi 微信和验证码授权上网配置信息
define('CONFIG_PATH', ROOT_PATH . '/config');
include_once (CONFIG_PATH . '/_global' . PHP_EXT);

include_once (DEPS_PATH . '/verify_code' . PHP_EXT);
include_once (DEPS_PATH . '/get_site' . PHP_EXT);
include_once (DEPS_PATH . '/Mysql' . PHP_EXT);
include_once (DEPS_PATH . '/Browscap' . PHP_EXT);

include_once (LIBRARIES_PATH . '/Bootstrap' . PHP_EXT);
include_once (LIBRARIES_PATH . '/UniFi' . PHP_EXT);
include_once (LIBRARIES_PATH . '/Uri' . PHP_EXT);
//-----------------------------------系统配置（不要修改）-----------------------------------------

//-----------------------------------前端配置---------------------------------------------------
define('STATIC_PATH', '../../statics');
define('CSS_PATH', STATIC_PATH . '/css');
define('JS_PATH', STATIC_PATH . '/js');
define('BOOTSTRAP_CSS_PATH', STATIC_PATH . '/node_modules/bootstrap/dist/css');
define('BOOTSTRAP_JS_PATH', STATIC_PATH . '/node_modules/bootstrap/dist/js');
define('JQUERY_PATH', STATIC_PATH . '/node_modules/jquery/dist');
//-----------------------------------前端配置---------------------------------------------------