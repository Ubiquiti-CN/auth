<?php

function get_site($dir) {
    $array_tmp = explode(DIRECTORY_SEPARATOR, $dir);
    $site = end($array_tmp);
    return is_string($site) ? $site : 'default';
}