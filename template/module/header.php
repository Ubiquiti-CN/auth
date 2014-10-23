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
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/reset.css">
    <?php
        if (isset($css_array) && is_array($css_array) && count($css_array) > 0) {
            foreach($css_array as $k => $v) {
                echo '<link rel="stylesheet" href="' . CSS_PATH . '/' . $v . '">';
            }
        }
    ?>
    <script src="<?php echo JQUERY_PATH ?>/jquery.min.js"></script>
    <script src="<?php echo BOOTSTRAP_JS_PATH ?>/bootstrap.min.js"></script>
    <title><?php echo (isset($title) ? $title : 'ubnt');?></title>
</head>
<body>

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="http://www.ubnt.com.cn" class="navbar-brand hidden-sm">ubnt</a>
            </div>
            <div role="navigation" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                </ul>
            </div>
        </div>
    </div>