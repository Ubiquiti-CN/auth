<?php

class UbntMysql {

    private static $_mysql=null;
    private static $_db=null;
    public static function get_instance($db_config) {
        if (self::$_db instanceof UbntMysql) {

        } else {
            $db = new mysqli($db_config['host'], $db_config['user'],
                             $db_config['pass'], $db_config['name'],
                             $db_config['port']);
            if ($db->connect_error) {
                $db = new mysqli($db_config['host'], $db_config['user'],
                                 $db_config['pass'], $db_config['name'],
                                 $db_config['port']);
                if ($db->connect_error) {
                    throw new Exception('数据库维护中，请稍后再试', $db->errno);
                }
            }
            $charset = isset($db_config['char']) ? $db_config['char'] : 'utf8';
            if ($charset)
                $db->set_charset($charset);
            self::$_mysql = $db;
            self::$_db = new self();
        }
        return self::$_db;
    }

    public static function query($query, $result_mode='default', $paramter='') {
        $res = self::$_mysql->query($query);
        if ($res === FALSE) {
            throw new Exception('数据库维护中，请稍后再试', self::$_mysql->errno);
        }
        $result = '';
        switch ($result_mode) {
            case '1':
                $result = $res->fetch_row();
                if ($result)
                    $result = $result[0];
                break;
            case 'array':
                $result = $res->fetch_array(MYSQLI_ASSOC);
                break;
            case 'row':
                $result = $res->fetch_row();
                break;
            case 'all':
                while ($row = $res->fetch_array(MYSQLI_ASSOC))
                    $result[] = $row;
                break;
            case 'param':
                while ($row = $res->fetch_array(MYSQLI_ASSOC))
                    $result[] = $row[$paramter];
                break;
            case 'id':
                $result = self::$_mysql->insert_id;
                break;
            default:
                $result = $res;
                break;
        }
        return $result;
    }

    public function close() {
        self::$_mysql->close();
    }

    private function __construct() {}

 }