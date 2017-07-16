# WeChat
基于swoole/bootstrap开发的在线聊天室

版本历程:
7.17 初始版本已完成
      登陆->选择头像->进入聊天室

未来版本展望
添加发布图片功能,添加发布表情,在线列表

安装说明:
服务器环境需求  phpweb环境(linux+php+appache或linux+php+nginx)  +swoole

1.服务器需要安装swoole  并用php执行/swoole_app/wechat_app.php脚本文件

2.需要修改  /app.js  中的ws请求地址为相应域名
line 42 
var ws = new WebSocket('ws://localhost:9502');

如有问题请联系作者 tiezhaowang@yahoo.com

