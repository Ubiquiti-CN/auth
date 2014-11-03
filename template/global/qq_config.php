<script id="qq-template" type="x-tmpl-mustache">
<div id="qq-config" class="row">
    <input type="hidden" name="qq_config" value="enable" />
    <?php
    if (isset($details) && isset($details[4]))
        $detail = json_decode($details[4], true);
    ?>
    <div class="col-xs-offset-1">
        <div class="form-group">
            <label for="qq_wifi_expired_time">授权过期时间（分钟）</label>
            <input type="text" class="form-control" id="qq_wifi_expired_time" name="qq_wifi_expired_time" placeholder="如：60" <?php if (isset($detail['qq_wifi_expired_time']) && $detail['qq_wifi_expired_time']) echo "value='{$detail['qq_wifi_expired_time']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_default_url">默认跳转地址</label>
            <input type="text" class="form-control" id="qq_default_url" name="qq_default_url" placeholder="如：http://www.ubnt.com.cn" <?php if (isset($detail['qq_default_url']) && $detail['qq_default_url']) echo "value='{$detail['qq_default_url']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_app_id">APP ID</label>
            <input type="text" class="form-control" id="qq_app_id" name="qq_app_id" <?php if (isset($detail['qq_app_id']) && $detail['qq_app_id']) echo "value='{$detail['qq_app_id']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_app_key">APP KEY</label>
            <input type="text" class="form-control" id="qq_app_key" name="qq_app_key" <?php if (isset($detail['qq_app_key']) && $detail['qq_app_key']) echo "value='{$detail['qq_app_key']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_callback_url">callback url</label>
            <input type="text" class="form-control" id="qq_callback_url" name="qq_callback_url" <?php if (isset($detail['qq_callback_url']) && $detail['qq_callback_url']) echo "value='{$detail['qq_callback_url']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_add_idol_by_name">关注微博名称</label>
            <input type="text" class="form-control" id="qq_add_idol_by_name" name="qq_add_idol_by_name" <?php if (isset($detail['qq_add_idol_by_name']) && $detail['qq_add_idol_by_name']) echo "value='{$detail['qq_add_idol_by_name']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_send_weibo_message">发送微博内容</label>
            <input type="text" class="form-control" id="qq_send_weibo_message" name="qq_send_weibo_message" <?php if (isset($detail['qq_send_weibo_message']) && $detail['qq_send_weibo_message']) echo "value='{$detail['qq_send_weibo_message']}'"?> >
        </div>
        <div class="form-group">
            <label for="qq_debug"> debug
                <input type="checkbox" id="qq_debug" name="qq_debug" <?php if (isset($detail['qq_debug']) && $detail['qq_debug'] == 'on') echo "checked='checked'"?> >
            </label>
        </div>
    </div>
</div>
</script>