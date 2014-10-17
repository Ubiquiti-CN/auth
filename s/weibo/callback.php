<?php

session_start();

header('Content-Type: text/html; charset=UTF-8');
include_once('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);
include_once(WEIBO_PATH . '/saetv2.ex.class.php');

$Mac_ID = isset($_SESSION['Mac_ID']) ? addslashes($_SESSION['Mac_ID']) : '';
if (!$Mac_ID) {
    header('Location: ' . DEFAULT_URL);
    exit();
}

$o = new SaeTOAuthV2( WEIBO_AKEY , WEIBO_SKEY );

if (isset($_REQUEST['code'])) {
    $keys = array();
    $keys['code'] = $_REQUEST['code'];
    $keys['redirect_uri'] = WEIBO_CALLBACK_URL;
    try {
        $token = $o->getAccessToken( 'code', $keys ) ;
    } catch (OAuthException $e) {

    }
}

if ($token) {
    $c = new SaeTClientV2( WEIBO_AKEY , WEIBO_SKEY , $token['access_token'] );
    
    setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );

    $follow = $c->follow_by_name(WEIBO_NAME);//关注用户
    $send = $c->update(WEIBO_MESSAGE);//发送微博
    if(isset($follow['error_code'])
        && $follow['error_code'] > 0) {
        echo WEIBO_FOLLOW_ERROR_MESSAGE;exit;
    } else if(isset($send['error_code'])
        && $send['error_code'] > 0 ) {
        echo WEIBO_SEND_ERROR_MESSAGE;exit;
    }
    
    UniFi::set_site($site);
    UniFi::sendAuthorization($Mac_ID, WIFI_EXPIRED_TIME);
    sleep(5);
    header('Location: ' . DEFAULT_URL);
} else {
    echo '授权失败。';
}