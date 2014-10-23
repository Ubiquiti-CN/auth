<script id="weixin-template" type="x-tmpl-mustache">
<div id="weixin-config" class="row">
    <div class="col-xs-offset-1">
        <div class="form-group">
            <label for="weixin_wifi_expired_time">授权过期时间（分钟）</label>
            <input type="text" class="form-control" id="weixin_wifi_expired_time" name="weixin_wifi_expired_time" placeholder="如：60" >
        </div>
        <div class="form-group">
            <label for="weixin_default_url">默认跳转地址</label>
            <input type="text" class="form-control" id="weixin_default_url" name="weixin_default_url" placeholder="如：http://www.ubnt.com.cn" >
        </div>
        <div class="form-group">
            <label for="weixin_token">weixin_token(令牌)</label>
            <input type="text" class="form-control" id="weixin_token" name="weixin_token" >
        </div>
        <div class="form-group">
            <label for="weixin_encoding_enable">加密 
            <input type="checkbox" id="weixin_encoding_enable" name="weixin_encoding_enable" >
            </label>
        </div>
        <div class="form-group">
            <label for="weixin_encoding_aes_key">EncodingAESKey(消息加解密密钥)</label>
            <input type="text" class="form-control" id="weixin_encoding_aes_key" name="weixin_encoding_aes_key" >
        </div>
        <div class="form-group">
            <label for="weixin_app_id">app id</label>
            <input type="text" class="form-control" id="weixin_app_id" name="weixin_app_id" >
        </div>
        <div class="form-group">
            <label for="weixin_app_secret">app secret</label>
            <input type="text" class="form-control" id="weixin_app_secret" name="weixin_app_secret" >
        </div>
        <div class="form-group">
            <label for="weixin_auth_message">授权信息</label>
            <input type="text" class="form-control" id="weixin_auth_message" name="weixin_auth_message" placeholder="当用户发送此内容获取授权链接" >
        </div>
        <div class="form-group">
            <label for="weixin_welcome_message">关注欢迎信息</label>
            <input type="text" class="form-control" id="weixin_welcome_message" name="weixin_welcome_message" placeholder="关注后的欢迎内容" >
        </div>
    </div>
</div>
</script>