<script id="weixin-template" type="x-tmpl-mustache">
<div id="weixin-config" class="row">
    <input type="hidden" name="weixin_config" value="enable" />
    <?php
    if (isset($details) && isset($details[3]))
        $detail = json_decode($details[3], true);
    ?>
    <div class="col-xs-offset-1">
        <div class="form-group">
            <label for="weixin_wifi_expired_time">授权过期时间（分钟）</label>
            <input type="text" class="form-control" id="weixin_wifi_expired_time" name="weixin_wifi_expired_time" placeholder="如：60" <?php if (isset($detail['weixin_wifi_expired_time']) && $detail['weixin_wifi_expired_time']) echo "value='{$detail['weixin_wifi_expired_time']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_default_url">默认跳转地址</label>
            <input type="text" class="form-control" id="weixin_default_url" name="weixin_default_url" placeholder="如：http://www.ubnt.com.cn" <?php if (isset($detail['weixin_default_url']) && $detail['weixin_default_url']) echo "value='{$detail['weixin_default_url']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_token">weixin_token(令牌)</label>
            <input type="text" class="form-control" id="weixin_token" name="weixin_token" <?php if (isset($detail['weixin_token']) && $detail['weixin_token']) echo "value='{$detail['weixin_token']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_encoding_enable">加密 
            <input type="checkbox" id="weixin_encoding_enable" name="weixin_encoding_enable" <?php if (isset($detail['weixin_encoding_enable']) && $detail['weixin_encoding_enable'] == 'on') echo "checked='checked'"?> >
            </label>
        </div>
        <div class="form-group">
            <label for="weixin_encoding_aes_key">EncodingAESKey(消息加解密密钥)</label>
            <input type="text" class="form-control" id="weixin_encoding_aes_key" name="weixin_encoding_aes_key" <?php if (isset($detail['weixin_encoding_aes_key']) && $detail['weixin_encoding_aes_key']) echo "value='{$detail['weixin_encoding_aes_key']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_app_id">app id</label>
            <input type="text" class="form-control" id="weixin_app_id" name="weixin_app_id" <?php if (isset($detail['weixin_app_id']) && $detail['weixin_app_id']) echo "value='{$detail['weixin_app_id']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_app_secret">app secret</label>
            <input type="text" class="form-control" id="weixin_app_secret" name="weixin_app_secret" <?php if (isset($detail['weixin_app_secret']) && $detail['weixin_app_secret']) echo "value='{$detail['weixin_app_secret']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_auth_message">授权信息</label>
            <input type="text" class="form-control" id="weixin_auth_message" name="weixin_auth_message" placeholder="当用户发送此内容获取授权链接" <?php if (isset($detail['weixin_auth_message']) && $detail['weixin_auth_message']) echo "value='{$detail['weixin_auth_message']}'"?> >
        </div>
        <div class="form-group">
            <label for="weixin_welcome_message">关注欢迎信息</label>
            <input type="text" class="form-control" id="weixin_welcome_message" name="weixin_welcome_message" placeholder="关注后的欢迎内容" <?php if (isset($detail['weixin_welcome_message']) && $detail['weixin_welcome_message']) echo "value='{$detail['weixin_welcome_message']}'"?> >
        </div>
    </div>
</div>
</script>