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
            $site = $_POST['site'];
            $sql = "INSERT INTO `site` (`site_name`) VALUES ('{$site}')";
            $id = $mysql->query($sql, 'id');
            $redirect = "/admin/manage_site/list";
            header('Location: ' . $redirect);
            return;
        } else if ($func == 'detail') {

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


    }
}