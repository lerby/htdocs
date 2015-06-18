<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 16:23
 */

include '../../classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', 'qwe', 'a_shop');
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
    if (isset($_POST['submit'])) {
        $title = mysql_real_escape_string($_POST['title']);
        $query = mysql_query("INSERT INTO categories (title) VALUES ('".$title."')");
        header("Location: delete.php"); exit();
    } else {
        print '<form method="POST">
            Название категории <input name="title" type="text"><br>
            <input name="submit" type="submit" value="Добавить">
            </form>';
    }




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