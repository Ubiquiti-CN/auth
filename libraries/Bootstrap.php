<?php

class Bootstrap {

    private function __construct() {}

    public static function run() {
        $mode = Uri::call('mode');
        switch ($mode) {
            case 'portal':
                $site = Uri::call('site');

                break;
            case 'config':
                $view = (Uri::call('view')) ? Uri::call('view') : 'create_site';
                include TEMPLATE_PATH . "/admin/{$view}.php";
                break;
            default:
                break;
        }


    }

}