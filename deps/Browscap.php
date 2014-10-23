<?php

class Browscap {

    const MOBILE = 'Mobile';
    const NOT_MOBILE = 'Not_Mobile';
    public static function get_type() {
        if (stripos($_SERVER['HTTP_USER_AGENT'], self::MOBILE)) {
            return self::MOBILE;
        } else {
            return self::NOT_MOBILE;
        }
    }

    private function __construct() {}

}