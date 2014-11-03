<form role="form" class="right-content" action="/admin/post/detail" method="post">
    <input type="hidden" name="submit" value="detail" />
    <input type="hidden" name="site_id" value="<?php echo $site_id;?>" />
    <div class="form-group">
        <label for="site">功能开启</label>
        <div class="col-xs-offset-1">
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="verifycode" <?php if (isset($details) && isset($details[1])) echo "checked='checked'"?> > verifyCode
                </label>
            </div>
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="weibo" <?php if (isset($details) && isset($details[2])) echo "checked='checked'"?> > weibo
                </label>
            </div>
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="weixin" <?php if (isset($details) && isset($details[3])) echo "checked='checked'"?> > weixin
                </label>
            </div>
            <div class="col-xs-12">
                <label>
                    <input type="checkbox" class="auth-type" id="" value="qq" <?php if (isset($details) && isset($details[4])) echo "checked='checked'"?> > qq
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
