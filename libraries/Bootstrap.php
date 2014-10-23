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

                include TEMPLATE_PATH . "/admin/create_site.php";
                break;
            default:
                break;
        }


    }

}