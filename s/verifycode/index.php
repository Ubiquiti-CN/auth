<?php
include_once ('../../config.php');
$site = get_site(__DIR__);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);

$Mac_ID = isset($_GET['id']) ? addslashes($_GET['id']) : '';
if (!$Mac_ID) {
    header('Location: ' . DEFAULT_URL);
    exit();
}

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/guest/statics/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/guest/statics/node_modules/bootstrap/dist/css/bootstrap-theme.min.css">
    <script src="/guest/statics/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/guest/statics/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title></title>
</head>
<body>
    <div class="container">
        <form role="form" id="verifyCodeForm">
            <div class="form-group verifyCodeGroup">
                <label class="control-label" for="verifyCode">验证码</label>
                <div class="row">
                    <div class="col-xs-8">
                        <input type="text" name="code" class="form-control" id="verifyCode" placeholder="验证码">
                    </div>
                    <div class="col-xs-4" style="padding-left:0;">
                        <img id="verifyCodeImg" style="cursor:pointer;" src="image.php">
                    </div>
                </div>
            </div>
            <button type="submit" id="verifyCodeSubmit" class="btn btn-primary">提交</button>
        </form>
    </div>
</body>
</html>
<script type="text/javascript">
    $(document).on('click', '#verifyCodeImg', function(event) {
        event.preventDefault();
        var $this = $(this);
        var oImg = $this[0];
        var date = +new Date();
        var src = "image.php?v=" + date;
        oImg.src = src;
        return false;          
    }).on('click', '#verifyCodeSubmit', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $this = $(this);
        $this.attr('disabled', 'disabled');
        $.ajax({
            url: 'ajax.php?<?php echo $_SERVER['QUERY_STRING'];?>',
            type: 'GET',
            dataType: 'json',
            data: $('#verifyCodeForm').serialize()
        })
        .done(function(data) {
            if (data.code == '0') {
                $('.verifyCodeGroup').addClass('has-error');
                $this.removeAttr('disabled', 'disabled');
            } else {
                $('.verifyCodeGroup').removeClass('has-error');
                setTimeout(function(){
                    $this.removeAttr('disabled', 'disabled');
                    window.location.href = '<?php echo DEFAULT_URL;?>';
                }, 5000);
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        return false;
    });
</script>