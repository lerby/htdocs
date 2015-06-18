<?php
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/left.php';
include_once '../blocks/user_header.php';

if (logIn()) {
    print "Вы вошли как ".$logination->userName."!<br>";
    if ($logination->isAdmin) {
        print '<a href="/admin.php">Админка</a><br><br>';
    }
    print '<a href="javascript:logOut()">Выйти</a>';
}




















