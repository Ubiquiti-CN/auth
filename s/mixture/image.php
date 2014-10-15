<?php

include_once ('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

session_start();
getCode(4, 68, 34);