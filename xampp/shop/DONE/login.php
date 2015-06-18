<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 12:20
 */

include 'classes/login.php';

function logination()
{
    $logination = new loginWorker();

    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $id = mysql_real_escape_string($_COOKIE['id']);
        $hash = mysql_real_escape_string($_COOKIE['hash']);

        $logination->isLoggedIn($id, $hash);
    }

    if (isset($_POST['submit'])) {
        $login = mysql_real_escape_string($_POST['login']);
        $password = mysql_real_escape_string($_POST['password']);

        if ($logination->logIn($login, $password)) {
            setcookie("id", $data['id'], time() + 60 * 60 * 24 * 30);
            setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
            header("Location: login.php");
            exit();
        }

        $query = mysql_query("SELECT id, password FROM users WHERE login='" . $login . "' LIMIT 1");
        $data = mysql_fetch_assoc($query);

        if ($data['password'] === md5(md5($_POST['password']))) {
            $hash = md5(generateCode());
            mysql_query("UPDATE users SET hash='" . $hash . "' WHERE id=" . $data['id']);
            setcookie("id", $data['id'], time() + 60 * 60 * 24 * 30);
            setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
        }
    }

    print $logination->getLoginBlock();
}








