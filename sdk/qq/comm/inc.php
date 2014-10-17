<?php die('forbidden'); ?>
{
    "appid": "<?php echo QQ_APPID;?>",
    "appkey": "<?php echo QQ_APPKEY;?>",
    "callback": "<?php echo QQ_CALLBACK_URL;?>",
    "scope": "add_t,add_pic_t,add_idol",
    "errorReport": <?php echo QQ_DEBUG;?>,
    "storageType": "file",
    "host": "localhost",
    "user": "root",
    "password": "root",
    "database": "test"
}