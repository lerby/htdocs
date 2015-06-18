<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 17:28
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

    if (isset($_POST['submit'])) {
        $selected = $_POST['selected'];
        foreach ($selected as $item) {
            $query = mysql_query("SELECT blocked FROM users WHERE id=".mysql_real_escape_string($item)." LIMIT 1");
            $row = mysql_fetch_assoc($query);
            if ($row['blocked'] == 0)
                $query = mysql_query("UPDATE users SET blocked=1 WHERE id=".mysql_real_escape_string($item));
            else
                $query = mysql_query("UPDATE users SET blocked=0 WHERE id=".mysql_real_escape_string($item));


           // print $item."<br>";
        }
        header("Location: users.php"); exit();
    } else {
        $query = mysql_query("SELECT id, login, blocked FROM users");

        print '<form method="POST">
            <table>
                <tr>
                    <th></th>
                    <th>Логин</th>
                    <th>Заблокирован</th>
                </tr>';

        while ($row = mysql_fetch_assoc($query)) {
            print '<tr>';
            print '<td>';
            print '<input type="checkbox" name="selected[]" value="' . $row['id'] . '">';
            print '</td>';
            print '<td>';
            print $row['login'];
            print '</td>';
            print '<td>';
            if ($row['blocked'] == 0)
                print "Нет";
            else
                print "Да";
            print '</td>';
            print '</tr>';
        }

        print '</table><input name="submit" type="submit" value="Заблокировать/Разблокировать"></form>';
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