<?php

include_once ('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

define('CANDIDATE_MODE_WEIBO', 'weibo');
define('CANDIDATE_MODE_WEIXIN', 'weixin');
define('CANDIDATE_MODE_VERIFY_CODE', 'verify_code');

$mode = isset($_GET['mode']) ? addslashes($_GET['mode']) : '';

if (!in_array($mode, get_candidate_modes())) {

}

switch($mode) {
    case CANDIDATE_MODE_WEIBO:
        session_start();

        header('Content-Type: text/html; charset=UTF-8');
        include_once(WEIBO_PATH . '/saetv2.ex.class.php');

        $o = new SaeTOAuthV2( WEIBO_AKEY , WEIBO_SKEY );

        $Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
        $code_url = $o->getAuthorizeURL(WEIBO_CALLBACK_URL);
        if (!$Mac_ID) {
            header('Location: ' . DEFAULT_URL);
            exit();
        }
        $_SESSION['Mac_ID'] = $Mac_ID;

        echo '';
        break;
    case CANDIDATE_MODE_WEIXIN:
        $Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
        $fromUserName = isset($_GET['fromUserName']) ? addslashes($_GET['fromUserName']) : '';

        include_once (DEPS_PATH . '/weixin_success.php');

        if (!$Mac_ID) {
            header('Location: template/introduce.html');
            exit();
        }

        $sql = "select * from " . WEIXIN_TABLE . "
        where `Mac_ID` = '{$Mac_ID}'";
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
        break;
    case CANDIDATE_MODE_VERIFY_CODE:
        $Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
        if (!$Mac_ID) {
            header('Location: ' . DEFAULT_URL);
            exit();
        }
        
        echo '';
        break;
    default:

        break;
}

function get_candidate_modes() {
    $candidate_modes = array();
    if (WEIBO_ENABLE) {
        $candidate_modes[] = CANDIDATE_MODE_WEIBO;
    }
    if (WEIXIN_ENABLE) {
        $candidate_modes[] = CANDIDATE_MODE_WEIXIN;
    }
    if (VERIFY_CODE_ENABLE) {
        $candidate_modes[] = CANDIDATE_MODE_VERIFY_CODE;
    }
    return $candidate_modes;
}