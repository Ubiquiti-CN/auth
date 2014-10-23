<?php

class Uri {

    private function __construct() {}

    public static function call($query) {
        return isset($_GET[$query]) ? addslashes($_GET[$query]) : '';
    }

}