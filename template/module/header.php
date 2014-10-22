<?php
include_once('../../config.php');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS_PATH ?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS_PATH ?>/bootstrap-theme.min.css">
    <script src="<?php echo JQUERY_PATH ?>/jquery.min.js"></script>
    <script src="<?php echo BOOTSTRAP_JS_PATH ?>/bootstrap.min.js"></script>
    <title><?php echo (isset($title) ? $title : 'ubnt');?></title>
</head>
<body>
