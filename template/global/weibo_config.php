<script id="weibo-template" type="x-tmpl-mustache">
<div id="weibo-config" class="row">
    <input type="hidden" name="weibo_config" value="enable" />
    <?php
    if (isset($details) && isset($details[2]))
        $detail = json_decode($details[2], true);
    ?>
    <div class="col-xs-offset-1">
        <div class="form-group">
            <label for="weibo_wifi_expired_time">授权过期时间（分钟）</label>
            <input type="text" class="form-control" id="weibo_wifi_expired_time" name="weibo_wifi_expired_time" placeholder="如：60"  <?php if (isset($detail['weibo_wifi_expired_time']) && $detail['weibo_wifi_expired_time']) echo "value='{$detail['weibo_wifi_expired_time']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_default_url">默认跳转地址</label>
            <input type="text" class="form-control" id="weibo_default_url" name="weibo_default_url" placeholder="如：http://www.ubnt.com.cn"  <?php if (isset($detail['weibo_default_url']) && $detail['weibo_default_url']) echo "value='{$detail['weibo_default_url']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_app_id">APP ID</label>
            <input type="text" class="form-control" id="weibo_app_id" name="weibo_app_id"  <?php if (isset($detail['weibo_app_id']) && $detail['weibo_app_id']) echo "value='{$detail['weibo_app_id']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_app_key">APP KEY</label>
            <input type="text" class="form-control" id="weibo_app_key" name="weibo_app_key"  <?php if (isset($detail['weibo_app_key']) && $detail['weibo_app_key']) echo "value='{$detail['weibo_app_key']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_callback_url">callback url</label>
            <input type="text" class="form-control" id="weibo_callback_url" name="weibo_callback_url"  <?php if (isset($detail['weibo_callback_url']) && $detail['weibo_callback_url']) echo "value='{$detail['weibo_callback_url']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_add_idol_by_name">关注微博名称</label>
            <input type="text" class="form-control" id="weibo_add_idol_by_name" name="weibo_add_idol_by_name"  <?php if (isset($detail['weibo_add_idol_by_name']) && $detail['weibo_add_idol_by_name']) echo "value='{$detail['weibo_add_idol_by_name']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_send_weibo_message">发送微博内容</label>
            <input type="text" class="form-control" id="weibo_send_weibo_message" name="weibo_send_weibo_message"  <?php if (isset($detail['weibo_send_weibo_message']) && $detail['weibo_send_weibo_message']) echo "value='{$detail['weibo_send_weibo_message']}'"?> >
        </div>
        <div class="form-group">
            <label for="weibo_debug"> debug
                <input type="checkbox" id="weibo_debug" name="weibo_debug"  <?php if (isset($detail['weibo_debug']) && $detail['weibo_debug'] == 'on') echo "checked='checked'"?> >
            </label>
        </div>
    </div>
</div>
</script>