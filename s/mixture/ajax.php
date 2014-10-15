<?php

include_once ('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

$array_tmp = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$site = end($array_tmp);
$site = is_string($site) ? $site : 'default';

$Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
$verify_code = isset($_GET['code']) ? trim(addslashes($_GET['code'])) : '';

if (!$Mac_ID) {
    header('Location: http://www.ubnt.com.cn');
    exit();
}

$sql = "select * from " . VERIFY_CODE_TABLE . " where `Mac_ID` = '{$Mac_ID}'";
$res = $mysql->query($sql, 'all');

if (!is_array($res) || count($res) <= 0) {
    session_start();
    if (!$verify_code
        || $verify_code != $_SESSION["ubnt_verify_num"]) {
        $res['code'] = 0; 
        $res['msg'] = 'verify_code_error';
        echo json_encode($res);
        exit();
    }

    $sql = "insert into " . VERIFY_CODE_TABLE . " (`Mac_ID`)
            values ('{$Mac_ID}')";
    $mysql->query($sql);
}

UniFi::set_site($site);
UniFi::sendAuthorization($Mac_ID, WIFI_EXPIRED_TIME);
exit();