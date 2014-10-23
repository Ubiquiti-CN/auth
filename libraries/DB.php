<?php

class DB {

    public static function get_instance() {
        $config = array(
            'host' => DB_HOST,
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'name' => DB_DBNAME,
            'port' => DB_PORT,
        );

        return UbntMysql::get_instance($config);
    }

}