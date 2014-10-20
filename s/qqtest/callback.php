<?php

session_start();

include_once('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);
include_once(QQ_PATH . '/qqConnectAPI.php');

$Mac_ID = $_SESSION['Mac_ID'];

$qc = new QC();
$acs = $qc->qq_callback();
$oid = $qc->get_openid();
$qc = new QC($acs,$oid);
$user = $qc->get_user_info();
$idol = array (
    'name' => QQ_ADD_IDOL_BY_NAME
);
$content = array(
    'content' => QQ_SEND_WEIBO_MESSAGE
);

$idol_ret = $qc->add_idol($idol);
$content_ret = $qc->add_t($content);

UniFi::set_site($site);
UniFi::sendAuthorization($Mac_ID, WIFI_EXPIRED_TIME);
sleep(5);
header('Location: ' . DEFAULT_URL);