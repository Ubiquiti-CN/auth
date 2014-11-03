<?php

class Bootstrap {

    private function __construct() {}

    public static function run() {
        $mode = Uri::call('mode');
        switch ($mode) {
            case 'portal':
                $site = Uri::call('site');

                break;
            case 'admin':
                $ctrl = (Uri::call('ctrl')) ? Uri::call('ctrl') : 'create';
                $func = (Uri::call('func')) ? Uri::call('func') : 'site';
                if ($ctrl == 'post') {
                    self::post($func);
                    break;
                }
                $template = array('ctrl' => $ctrl, 'func' => $func,);
                self::deal($template);
                break;
            case 'post':
                self::post();
                break;
            default:
                break;
        }

    }

    public static function post($func) {
        global $mysql;

        if ($func == 'site') {
            if (isset($_POST['submit']) && $_POST['submit'] == 'site') {
                $site = $_POST['site'];
                $sql = "INSERT INTO `site` (`site_name`) VALUES ('{$site}')";
                $id = $mysql->query($sql, 'id');
                $redirect = "/admin/manage_site/list";
                header('Location: ' . $redirect);
                return;
            }
        } else if ($func == 'detail') {
            if (isset($_POST['submit']) && $_POST['submit'] == 'detail') {
                self::save_config();

            }
        }
    }

    private static function deal($template) {
        switch ($template['ctrl']) {
            case "create":
                self::view($template);
                break;
            case "manage_site":
                if ($template['func'] == 'list') {
                    $result['sites'] = self::get_site_list();
                } else if ($template['func'] == 'detail') {
                    $result['site_id'] = Uri::call('id');
                    $result['details'] = self::get_site_detail();
                }
                self::view($template, $result);
                break;
        }
    }

    private static function view($template, $result = '') {
        if ($result) {
            foreach ($result as $key => $val) {
                ${$key} = $val;
            }
        }
        $ctrl = $template['ctrl'];
        $func = $template['func'];
        include TEMPLATE_PATH . "/admin/{$ctrl}_{$func}.php";
    }


    private static function get_site_list() {
        global $mysql;

        $sql = "SELECT * FROM `site` ORDER BY `id`";
        $result = $mysql->query($sql, 'all');
        if ($result && count($result)) {
            return $result;
        } else {
            return array();
        }
    }

    private static function get_site_detail() {
        global $mysql;

        $site_id = Uri::call('id');
        $sql = "SELECT `auth_id`, `content` FROM `config` WHERE `site_id` = '{$site_id}'";
        $data = $mysql->query($sql, 'all');

        $result = array();
        if (is_array($data) && count($data)) {
            foreach ($data as $val) {
                $result[$val['auth_id']] = $val['content'];
            }
        }
        return $result;
    }

    private static function save_config() {
        global $mysql;

        $site_id = $_POST['site_id'];
        if (isset($_POST['verifycode_config']) && $_POST['verifycode_config'] == 'enable') {
            $auth_id = 1;
            $verifycode_config['verifycode_wifi_expired_time'] = $_POST['verifycode_wifi_expired_time'];
            $verifycode_config['verifycode_default_url'] = $_POST['verifycode_default_url'];

            $content = json_encode($verifycode_config, JSON_UNESCAPED_UNICODE);
            $sql_count = "SELECT COUNT(*) FROM `config` WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            $count = $mysql->query($sql_count, '1');
            if (isset($count) && $count) {
                $sql = "UPDATE `config` SET `content` = '{$content}' WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            } else {
                $sql = "INSERT INTO `config` (`site_id`, `auth_id`, `content`) VALUES ('{$site_id}', '{$auth_id}', '{$content}')";
            }
            echo "<pre>";
            echo $sql;
            $mysql->query($sql);
        }
        if (isset($_POST['qq_config']) && $_POST['qq_config'] == 'enable') {
            $auth_id = 4;
            $qq_config['qq_wifi_expired_time'] = $_POST['qq_wifi_expired_time'];
            $qq_config['qq_default_url'] = $_POST['qq_default_url'];
            $qq_config['qq_app_id'] = $_POST['qq_app_id'];
            $qq_config['qq_app_key'] = $_POST['qq_app_key'];
            $qq_config['qq_callback_url'] = $_POST['qq_callback_url'];
            $qq_config['qq_add_idol_by_name'] = $_POST['qq_add_idol_by_name'];
            $qq_config['qq_send_weibo_message'] = $_POST['qq_send_weibo_message'];
            $qq_config['qq_debug'] = $_POST['qq_debug'];

            $content = json_encode($qq_config, JSON_UNESCAPED_UNICODE);
            $sql_count = "SELECT COUNT(*) FROM `config` WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            $count = $mysql->query($sql_count, '1');
            if (isset($count) && $count) {
                $sql = "UPDATE `config` SET `content` = '{$content}' WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            } else {
                $sql = "INSERT INTO `config` (`site_id`, `auth_id`, `content`) VALUES ('{$site_id}', '{$auth_id}', '{$content}')";
            }
            $mysql->query($sql);
        }
        if (isset($_POST['weibo_config']) && $_POST['weibo_config'] == 'enable') {
            $auth_id = 2;
            $weibo_config['weibo_wifi_expired_time'] = $_POST['weibo_wifi_expired_time'];
            $weibo_config['weibo_default_url'] = $_POST['weibo_default_url'];
            $weibo_config['weibo_app_id'] = $_POST['weibo_app_id'];
            $weibo_config['weibo_app_key'] = $_POST['weibo_app_key'];
            $weibo_config['weibo_callback_url'] = $_POST['weibo_callback_url'];
            $weibo_config['weibo_add_idol_by_name'] = $_POST['weibo_add_idol_by_name'];
            $weibo_config['weibo_send_weibo_message'] = $_POST['weibo_send_weibo_message'];
            $weibo_config['weibo_debug'] = $_POST['weibo_debug'];

            $content = json_encode($weibo_config, JSON_UNESCAPED_UNICODE);
            $sql_count = "SELECT COUNT(*) FROM `config` WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            $count = $mysql->query($sql_count, '1');
            if (isset($count) && $count) {
                $sql = "UPDATE `config` SET `content` = '{$content}' WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            } else {
                $sql = "INSERT INTO `config` (`site_id`, `auth_id`, `content`) VALUES ('{$site_id}', '{$auth_id}', '{$content}')";
            }
            echo "<pre>";
            echo $sql;
            $mysql->query($sql);
        }
        if (isset($_POST['weixin_config']) && $_POST['weixin_config'] == 'enable') {
            $auth_id = 3;
            $weixin_config['weixin_wifi_expired_time'] = $_POST['weixin_wifi_expired_time'];
            $weixin_config['weixin_default_url'] = $_POST['weixin_default_url'];
            $weixin_config['weixin_token'] = $_POST['weixin_token'];
            $weixin_config['weixin_encoding_enable'] = $_POST['weixin_encoding_enable'];
            $weixin_config['weixin_encoding_aes_key'] = $_POST['weixin_encoding_aes_key'];
            $weixin_config['weixin_app_id'] = $_POST['weixin_app_id'];
            $weixin_config['weixin_app_secret'] = $_POST['weixin_app_secret'];
            $weixin_config['weixin_auth_message'] = $_POST['weixin_auth_message'];
            $weixin_config['weixin_welcome_message'] = $_POST['weixin_welcome_message'];

            $content = json_encode($weixin_config, JSON_UNESCAPED_UNICODE);
            $sql_count = "SELECT COUNT(*) FROM `config` WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            $count = $mysql->query($sql_count, '1');
            if (isset($count) && $count) {
                $sql = "UPDATE `config` SET `content` = '{$content}' WHERE `site_id` = '{$site_id}' AND `auth_id` = '{$auth_id}'";
            } else {
                $sql = "INSERT INTO `config` (`site_id`, `auth_id`, `content`) VALUES ('{$site_id}', '{$auth_id}', '{$content}')";
            }
            $mysql->query($sql);
        }



    }

}