<?php

function get_site() {
    $array_tmp = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
    $site = end($array_tmp);
    return is_string($site) ? $site : 'default';
}