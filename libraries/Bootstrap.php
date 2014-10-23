<?php

class Bootstrap {

    private function __construct() {}

    public static function run() {
        $query = Uri::call('site');
        print_r($query);

    }

}