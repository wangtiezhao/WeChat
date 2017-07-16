<?php
/**
 * Description:
 * Type:
 * User: NEW_WORLD
 * Date: 2017/7/15
 * Time: 19:30
 */

//创建websocket服务器对象，监听0.0.0.0:9502端口

$ws = new swoole_websocket_server("0.0.0.0", 9502);
$client_list = array();
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    echo "{$request->fd} link\n";
    //保存客户端信息
    global $client_list;
    var_dump($request);
    $client_list[$request->fd] = $request->cookie;
    var_dump($client_list);

    $nickname = $request->cookie['nickname'];
    $ip = $request->cookie['ip'];

    //告知其他客户端

    foreach ($client_list as $key => $value) {
        $data = array('type' => '上线',
            'detail' => array('nickname' => $nickname, 'ip' => $ip, 'time' => time(), 'list' => $client_list)
        );
        $ws->push($request->fd, json_encode($data));
    }


});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "{$frame->fd} 客户端发来了消息 $frame->data\n";
    global $client_list;

    //普通消息
    //广播客户端的消息

    foreach ($client_list as $key => $client) {
        $data = array('type' => '普通消息',
            'detail' => array('img' => $client_list[$frame->fd]['imgpath'], 'content' => $frame->data, 'nickname' => $client_list[$frame->fd]['nickname'], 'ip' => $client_list[$frame->fd]['ip'], 'time' => time())
        );


        $ws->push($key, json_encode($data));
    }


});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    global $client_list;
    unset($client_list[$fd]);
    echo "$fd closed\n";
    //广播断线消息
    foreach ($client_list as $key => $value) {
        $data = array('type' => '离线',
            'detail' => array('nickname' => $client_list[$fd]['nickname'], 'ip' => $client_list[$fd]['ip'], 'time' => time(), 'list' => $client_list)
        );
        $ws->push($key, json_encode($data));
    }

});

$ws->start();




