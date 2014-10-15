<?php

session_start();

header('Content-Type: text/html; charset=UTF-8');
include_once('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);
include_once(WEIBO_PATH . '/saetv2.ex.class.php');

$o = new SaeTOAuthV2( WEIBO_AKEY , WEIBO_SKEY );

$Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
$code_url = $o->getAuthorizeURL(WEIBO_CALLBACK_URL);
if (!$Mac_ID) {
    header('Location: ' . DEFAULT_URL);
    exit();
}
$_SESSION['Mac_ID'] = $Mac_ID;

?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body>
<!-- 授权按钮 -->
<p><a href="<?=$code_url?>"><img src="weibo_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a></p>

</body>
</html>