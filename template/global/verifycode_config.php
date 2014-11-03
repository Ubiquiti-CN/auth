<script id="verifycode-template" type="x-tmpl-mustache">
<div id="verifycode-config" class="row">
    <input type="hidden" name="verifycode_config" value="enable" />
    <div class="col-xs-offset-1">
    <?php
    if (isset($details) && isset($details[1]))
        $detail = json_decode($details[1], true);
    ?>
        <div class="form-group">
            <label for="verifycode_wifi_expired_time">授权过期时间（分钟）</label>
            <input type="text" class="form-control" id="verifycode_wifi_expired_time" name="verifycode_wifi_expired_time" placeholder="如：60" <?php if (isset($detail['verifycode_wifi_expired_time']) && $detail['verifycode_wifi_expired_time']) echo "value='{$detail['verifycode_wifi_expired_time']}'"?> >
        </div>
        <div class="form-group">
            <label for="verifycode_default_url">默认跳转地址</label>
            <input type="text" class="form-control" id="verifycode_default_url" name="verifycode_default_url" placeholder="如：http://www.ubnt.com.cn" <?php if (isset($detail['verifycode_default_url']) && $detail['verifycode_default_url']) echo "value='{$detail['verifycode_default_url']}'"?> >
        </div>
</script>