<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 14:52
 */

include '../classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');
$logged = false;
$err = array();
$permission = 0;

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);

    if(($userdata['hash'] !== $_COOKIE['hash']) and ($userdata['id'] !== $_COOKIE['id'])) {
        $err[] = "Пожалуйста, перелогиньтесь.";
        $logged = false;
    } else {
        $logged = true;
    }

    $permission = $userdata['permission'];
}

if ($logged and ($permission == 1)) {






} else {
    if (!$logged) {
        print "Вы не авторизованы<br>";
    } else {
        print "У вас недостаточно прав<br>";
    }

    foreach($err AS $error) {
        print $error."<br>";
    }
}