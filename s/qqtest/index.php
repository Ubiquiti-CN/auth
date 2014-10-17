<?php

session_start();

include_once('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

$Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';

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
<a href="auth.php"><img src="qq_login.png"></a>
</body>
</html>