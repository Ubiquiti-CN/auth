<?php

include_once ('../../config.php');

$site = get_site(__DIR__);
echo $site;exit;

include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

get_site();exit;

$Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
$fromUserName = isset($_GET['fromUserName']) ? addslashes($_GET['fromUserName']) : '';

include_once (DEPS_PATH . '/weixin_success.php');

if (!$Mac_ID) {
    header('Location: template/introduce.html');
    exit();
}

$sql = "select * from " . WEIXIN_TABLE . " where `Mac_ID` = '{$Mac_ID}'";
$res = $mysql->query($sql, 'all');

if (!is_array($res) || count($res) <= 0) {
    if (!$fromUserName) {
        header('Location: template/introduce.html');
        exit();
    }
    $sql = "insert into " . WEIXIN_TABLE . " (`Mac_ID`, `fromUserName`)
            values ('{$Mac_ID}', '{$fromUserName}')";
    $mysql->query($sql);
}

UniFi::set_site($site);
UniFi::sendAuthorization($Mac_ID, WIFI_EXPIRED_TIME);
sleep(5);
header('Location: ' . DEFAULT_URL);
exit();
