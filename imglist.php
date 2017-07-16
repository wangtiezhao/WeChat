<?php
/**
 * Description:
 * Type:
 * User: NEW_WORLD
 * Date: 2017/7/16
 * Time: 18:54
 */


    $nickname = strip_tags(trim($_POST['nickname']));
    if ($nickname == '') {
        echo '拒绝访问';
        header('location:login.html');
        exit;
    }
    if (mb_strlen($nickname) > 10) {
        echo '拒绝访问';
        header('location:login.html');
        exit;
    }
    setcookie('nickname' , $nickname,time()+3600*24,'/');
    setcookie('ip' , $_SERVER['REMOTE_ADDR'],time() + 3600 * 24,'/');
include 'imglist.html';