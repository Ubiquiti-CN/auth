<?php

header('Content-Type: text/html; charset=UTF-8');

include_once('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

$arr = array(
    "appid" => QQ_APPID,
    "appkey" => QQ_APPKEY,
    "callback" => QQ_CALLBACK_URL,
    "scope" => "add_t,add_pic_t,add_idol",
    "errorReport" => QQ_DEBUG,
    "storageType" => "file",
    "host" => "localhost",
    "user" => "root",
    "password" => "root",
    "database" => "test"
);
$setting = "<?php die('forbidden'); ?>\n";
$setting .= json_encode($_POST);
$setting = str_replace("\/", "/",$setting);
$incFile = fopen("inc.php","w+") or die("请设置inc.php的权限为777");
if(fwrite($incFile, $setting)){
    echo "配置成功";

    fclose($incFile);
    fclose(fopen("setted.inc", "w"));
}else{
    echo "Error";
}