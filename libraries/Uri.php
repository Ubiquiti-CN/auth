<?php

class Uri {

    private function __construct() {}

    public static function call($query) {
        return $_GET[$query];
    }

}