<?php
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/left.php';
include_once '../blocks/user_header.php';

if (logIn()) {
    print '<p style="font-size: 15px; padding: 3px; color: #b1b1b3;">';
    print "Вы вошли как ".$logination->userName."!<br>";
    if ($logination->isAdmin) {
        print '<a href="/admin.php" style="color: #2aa9e0; text-decoration: none;">Админка</a><br><br>';
    }
    print '<a href="javascript:logOut()" style="color: #ea4c89; text-decoration: none;">Выйти</a>';
    print '</p>';
}




















