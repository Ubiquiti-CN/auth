<?php

class Browscap {

    const REGEX_DELIMITER = '@';

    const COMPRESSION_PATTERN_START = '@';
    const COMPRESSION_PATTERN_DELIMITER = '|';

    private $_userAgents = array();
    private $_browsers = array();
    private $_patterns = array();
    private $_properties = array();

    public function __construct() {
        require BROWSCAP_CACHE_FILE;

        $this->_browsers = $browsers;
        $this->_userAgents = $userAgents;
        $this->_patterns = $patterns;
        $this->_properties = $properties;

        return true;
    }

    public function get_browser() {
        $user_agent = '';
        // Automatically detect the useragent
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        }

        $this->_log_user_agent($user_agent);

        $browser = array();
        foreach ($this->_patterns as $pattern => $pattern_data) {
            if (preg_match($pattern . 'i', $user_agent, $matches)) {
                if (1 == count($matches)) {
                    // standard match
                    $key = $pattern_data;

                    $simple_match = true;
                } else {
                    $pattern_data = unserialize($pattern_data);

                    // match with numeric replacements
                    array_shift($matches);

                    $match_string = self::COMPRESSION_PATTERN_START . implode(self::COMPRESSION_PATTERN_DELIMITER, $matches);

                    if (!isset($pattern_data[$match_string])) {
                        // partial match - numbers are not present, but everything else is ok
                        continue;
                    }

                    $key = $pattern_data[$match_string];

                    $simple_match = false;
                }

                $browser = array(
                    $user_agent, // Original useragent
                    trim(strtolower($pattern), self::REGEX_DELIMITER),
                    $this->_pregUnQuote($pattern, $simple_match ? false : $matches)
                );

                $browser = $value = $browser + unserialize($this->_browsers[$key]);

                while (array_key_exists(3, $value)) {
                    $value = unserialize($this->_browsers[$value[3]]);
                    $browser += $value;
                }

                if (!empty($browser[3])) {
                    $browser[3] = $this->_userAgents[$browser[3]];
                }

                break;
            }
        }

        // Add the keys for each property
        $array = array();
        foreach ($browser as $key => $value) {
            if ($value === 'true') {
                $value = true;
            } elseif ($value === 'false') {
                $value = false;
            }
            $array[$this->_properties[$key]] = $value;
        }

        return $array;
    }

    private function _pregUnQuote($pattern, $matches) {
        // list of escaped characters: http://www.php.net/manual/en/function.preg-quote.php
        // to properly unescape '?' which was changed to '.', I replace '\.' (real dot) with '\?', then change '.' to '?' and then '\?' to '.'.
        $search = array('\\' . self::REGEX_DELIMITER, '\\.', '\\\\', '\\+', '\\[', '\\^', '\\]', '\\$', '\\(', '\\)', '\\{', '\\}', '\\=', '\\!', '\\<', '\\>', '\\|', '\\:', '\\-', '.*', '.', '\\?');
        $replace = array(self::REGEX_DELIMITER, '\\?', '\\', '+', '[', '^', ']', '$', '(', ')', '{', '}', '=', '!', '<', '>', '|', ':', '-', '*', '?', '.');

        $result = substr(str_replace($search, $replace, $pattern), 2, -2);

        if ($matches)
        {
            foreach ($matches as $one_match)
            {
                $num_pos = strpos($result, '(\d)');
                $result = substr_replace($result, $one_match, $num_pos, 4);
            }
        }

        return $result;
    }

    private function _log_user_agent($user_agent) {
        if (!$user_agent) {
            return true;
        }

        $config = array(
            'host' => DB_HOST,
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'name' => DB_DBNAME,
            'port' => DB_PORT,
        );
        $mysql = UbntMysql::get_instance($config);

        $sql = "select * from " . USER_AGENT_LOG_TABLE . "
                where `user_agent` = '{$user_agent}";
        $result = $mysql::query($sql, '1');

        if (is_array($result) && count($result) > 0) {
            return true;
        }

        $sql = "insert into " . USER_AGENT_LOG_TABLE . "
                (`user_agent`) values ('{$user_agent}')";
        $mysql::query($sql);

        return true;
    }
}

