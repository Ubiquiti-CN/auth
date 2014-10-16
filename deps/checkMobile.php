<?php

/**
 *
 * 根据php的$_SERVER['HTTP_USER_AGENT'] 中各种浏览器访问时所包含各个浏览器特定的字符串来判断是属于PC还是移动端
 * @author           discuz3x
 * @lastmodify    2014-04-09
 * @return  BOOL
 */
function checkMobile() {
    $mobile = array();
    
    //各个触控浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
    static $touchbrowser_list = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini', 'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung', 'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser', 'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource', 'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone', 'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop', 'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
    
    //window手机浏览器数组【猜的】
    static $mobilebrowser_list = array('windows phone');
    
    //wap浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
    static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom', 'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh', 'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
    $pad_list = array('pad', 'gt-p1000');
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (dstrpos($useragent, $pad_list)) {
        return false;
    }
    if (($v = dstrpos($useragent, $mobilebrowser_list, true))) {
        return '1';
    }
    if (($v = dstrpos($useragent, $touchbrowser_list, true))) {
        return '2';
    }
    if (($v = dstrpos($useragent, $wmlbrowser_list))) {
        return '3';
         //wml版
        
    }
    $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
    if (dstrpos($useragent, $brower)) return false;
    
    return false;
}

/**
 * 判断$arr中元素字符串是否有出现在$string中
 * @param  $string     $_SERVER['HTTP_USER_AGENT']
 * @param  $arr          各中浏览器$_SERVER['HTTP_USER_AGENT']中必定会包含的字符串
 * @param  $returnvalue 返回浏览器名称还是返回布尔值，true为返回浏览器名称，false为返回布尔值【默认】
 * @author           discuz3x
 * @lastmodify    2014-04-09
 */
function dstrpos($string, $arr, $returnvalue = false) {
    if (empty($string)) return false;
    foreach ((array)$arr as $v) {
        if (strpos($string, $v) !== false) {
            $return = $returnvalue ? $v : true;
            return $return;
        }
    }
    return false;
}
