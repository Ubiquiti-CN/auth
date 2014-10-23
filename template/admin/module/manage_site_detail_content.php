<form role="form" class="right-content">
    <div class="form-group">
        <label for="site">功能开启</label>
        <div class="col-xs-offset-1">
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="verifycode"> verifyCode
                </label>
            </div>
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="weibo"> weibo
                </label>
            </div>
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="weixin"> weixin
                </label>
            </div>
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="qq"> qq
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php
    include_once(TEMPLATE_PATH . '/global/verifycode_config.php');
    include_once(TEMPLATE_PATH . '/global/weixin_config.php');
    include_once(TEMPLATE_PATH . '/global/weibo_config.php');
    include_once(TEMPLATE_PATH . '/global/qq_config.php');
?>
<script type="text/javascript">
    $(document).on('click', '.selector', function(event) {
        event.preventDefault();
        /* Act on the event */
    }).on('click', '.auth-type', function(event) {
        var $this = $(this),
            ele = $this[0],
            $container = $this.closest('.col-xs-12'),
            value = $this.val(),
            $config_template = $('#' + value + '-template').html(),
            $config = $('#' + value + '-config');
        if (ele.checked) {
            if ($config.length > 0) {
                $config.show();
            } else {
                $container.append($config_template);
            }
        } else {
            $config.hide();
        }
    });
    $('.auth-type').each(function(index, el) {
        var $this = $(this),
            ele = $this[0];
        if (ele.checked) {
            console.log(1);
            $this.trigger('click');
            setTimeout(function(){
                $this.trigger('click');
            }, 50);
        }
    });
</script>
