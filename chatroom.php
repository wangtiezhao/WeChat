<?php
/**
 * Description:
 * Type:
 * User: NEW_WORLD
 * Date: 2017/7/16
 * Time: 20:08
 */


    if (isset($_COOKIE['nickname'])&& isset($_COOKIE['imgpath'])) {
        include '__index.html';
    }else if(!isset($_POST['imgpath'])){
        header('location:login.html');
        exit;
    }else{
        setcookie('imgpath', basename($_POST['imgpath']), time() + 3600 * 24, '/');
        include '__index.html';
    }




