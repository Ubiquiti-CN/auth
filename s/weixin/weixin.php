<?php

include_once ('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);
include_once (WEIXIN_PATH . '/class/wechat.class.php');

if (WECHAT_ENCODING_ENABLE) {
    $options = array(
        'token' => WECHAT_TOKEN,
        'encodingaeskey' => WECHAT_ENCODING_AES_KEY,
        'appid' => WECHAT_APP_ID,
        'appsecret' => WECHAT_APP_SECRET,
    );
} else {
    $options = array(
        'token' => WECHAT_TOKEN,
    );
}

$weObj = new Wechat($options);
$weObj->valid();

$type = $weObj->getRev()->getRevType();
switch($type) {
    case Wechat::MSGTYPE_TEXT:
        $content = $weObj->getRev()->getRevContent();
        if ($content == WEIXIN_AUTH_MESSAGE) {
            $fromUserName = $weObj->getRev()->getRevFrom();
            $url = SERVER_HOST . "/guest/sdk/weixin/redirct.php?fromUserName=" . $fromUserName;
            $text = "<a href='{$url}'>点击上网</a>";
            $weObj->text($text)->reply();
        }
        break;
    case Wechat::MSGTYPE_EVENT:
        $revEvent = $weObj->getRev()->getRevEvent();
        $event = strtolower($revEvent['event']);
        if ($event == 'subscribe') {  //关注微信操作
            $weObj->text(WEIXIN_WELCOME_MESSAGE)->reply();
        } else if ($event == 'unsubscribe') {  //取消关注微信操作
            $fromUserName = $weObj->getRev()->getRevFrom();
            //取消上网权限
            $sql = "select * from " . WEIXIN_TABLE . "
                    WHERE `fromUserName` = '{$fromUserName}'";
            $res = $mysql->query($sql, 'all');

            if (is_array($res) && count($res) > 0) {
                //删除数据
                $sql = "DELETE FROM " . WEIXIN_TABLE . "
                        WHERE `fromUserName` = '{$fromUserName}'";
                $mysql->query($sql);

                foreach ($res as $key => $value) {
                    UniFi::sendUnauthorization($value['Mac_ID']);
                    sleep(2);
                }
            }
        }
        break;
    case Wechat::MSGTYPE_IMAGE:

        break;
    default:
        $weObj->text("help info")->reply();
        break;
}