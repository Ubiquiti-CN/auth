1.[UniFi AP的公共接口](http://dl.ubnt.com/unifi/4.2.0/unifi_sh_api)

2.[微信使用的sdk](https://github.com/dodgepudding/wechat-php-sdk)

3.服务器接口

|  接口  |  方法  | URL                                 | 参数 |  返回   |
|-----|-----|------------------------------------------|--------|---------------------- |
| 生成链接 | GET  | /site/{site}/openid/{openid} | []   |  200  xxxx/xxx?fromUserName={openid}    |
| 关联账号 | POST | /site/relate           | [{"openid":"{openid}", "mac":"{mac_address}"}] | 201 |
| 授权UAP | POST | /site/{site}/auth | [{"mac":"{mac_address}", "minutes":"{expire_minutes}"}] | 201 |
| 取消授权UAP | POST | /site/{site}/unauth | [{"mac":"{mac_address}"}] | 201 |