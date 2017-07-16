/**
 * Created by NEW_WORLD on 2017/7/16.
 */
    window.onload=function(){
        var send = document.getElementById('send');
        var msgbox=document.getElementById('msgbox');
        var showbar=document.getElementById('showbar');
        var clearok=document.getElementById('clearok');
        var container=document.getElementById('container');
        send.onclick=function(){
            var sendtext=msgbox.value;
            ws.send(sendtext);
            window.scrollTo(window.document.body.scrollWidth, window.document.body.scrollHeight);
        };
        function add(html){
            var node = document.createElement('li');
            node.className = 'media';
            node.innerHTML = html;
            window.showbar.appendChild(node);
        }
        clearok.onclick=function(){
            //console.log(container);
            //console.log(window.showbar);
            container.removeChild(window.showbar);
            window.showbar=document.createElement('ul');
            window.showbar.className='media-list';
            window.showbar.id='showbar';
            container.appendChild(window.showbar);
            //console.log(window.showbar);
        }

        var ws = new WebSocket('ws://www.wangtiezhao.bid:9502');
        //系统成功
        function successhtml(msg){
            return '<div class="media-body"> <div class="system-success">'+msg+'</div> </div>';
        }
        //系统错误
        function errorhtml(msg){
            return '<div class="media-body"> <div class="system-error">'+msg+'</div> </div>';
        }
        //普通消息
        function msghtml(detail){
            var time = new Date(detail.time*1000);
            var timeStr = time.toTimeString().split(' ')[0];
            return '<li class="media"> <a class="pull-left" href="#"> <img class="media-object" src="./img/'+detail.img+'" alt="..."> </a> <div class="media-body"> <div><span class="name">'+detail.nickname+'</span><span class="time">'+timeStr+'</span> <hr> <span class="content">'+detail.content+'</span></div> </div> </li>';
        }
        //下线
        function leavehtml(detail){
            var time = new Date(detail.time * 1000);
            var timeStr = time.toTimeString().split(' ')[0];
            return '<li class="media"> <div class="media-body"> <div class="system-connect">系统消息:' + timeStr + ' ' + detail.nickname + ' 上线了</div> </div> </li>';
        }
        //上线
        function onlinehtml(detail){
            var time = new Date(detail.time * 1000);
            var timeStr = time.toTimeString().split(' ')[0];
             return '<li class="media"> <div class="media-body"> <div class="system-leave">系统消息:'+ timeStr+' '+detail.nickname+' 离线了</div> </div> </li>';
        }
        ws.onopen = function (evt) {
            add(successhtml('您已成功连接服务器.现在开始畅所欲言吧..'));
        };

        ws.onmessage = function (evt) {
            var data = JSON.parse(evt.data);
            switch (data.type){
                case '上线':
                    add(onlinehtml(data.detail));
                    break;
                case '离线':
                    add(leavehtml(data.detail));
                    break;
                case '普通消息':
                    add(msghtml(data.detail));
                    break;
            }
        };

        ws.onclose = function (evt) {

            add(errorhtml('您已断开连接..尝试刷新页面连接'));
        };

    }