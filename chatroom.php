<?php
/**
 * Description:
 * Type:
 * User: NEW_WORLD
 * Date: 2017/7/16
 * Time: 20:08
 */


    if (!isset($_COOKIE['nickname'])) {
        header('location:login.html');
        exit;
    }
    if (!isset($_POST['imgpath'])|| $_POST['imgpath'] == '') {
        header('location:imglist.php');
        exit;
    }
    setcookie('imgpath', basename($_POST['imgpath']),  time() + 3600 * 24, '/');

include '__index.html';