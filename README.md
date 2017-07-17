<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<h3># WeChat</h3>
基于swoole/bootstrap开发的在线聊天室


<p>版本历程:</p>
<ul>
    <li>
        <p>7.17 初始版本已完成</p>
        <p>登陆->选择头像->进入聊天室</p>
    </li>
    <li>
        <p>7.18 修复了在线 离线不显示bug</p>
    </li>
    <li>
        <p>未来版本展望</p>
        <p>添加发布图片功能,添加发布表情,在线列表</p>
    </li>
</ul>


<p>安装说明:</p>
<ol>
    <li>服务器环境需求 phpweb环境(linux+php+appache或linux+php+nginx) +swoole</li>
    <li>服务器需要安装swoole 并用php执行/swoole_app/wechat_app.php脚本文件</li>
    <li>需要修改 /app.js 中的ws请求地址为相应域名<br>
        var ws = new WebSocket('ws://localhost:9502');  在 line 42
    </li>
</ol>


<P><a href="http://www.wangtiezhao.bid/wechat/login.html">在线聊天室Demo</a></P>

如有问题请联系作者 tiezhaowang@yahoo.com
</body>
</html>







