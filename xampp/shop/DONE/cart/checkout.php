<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 26.05.2015
 * Time: 0:11
 */

include '../classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');
$logged = false;
$err = array();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);

    if(($userdata['hash'] !== $_COOKIE['hash']) and ($userdata['id'] !== $_COOKIE['id'])) {
        print "Пожалуйста, переавторизуйтесь.";
        $logged = false;
        exit;
    } else {
        $logged = true;
    }
} else {
    print "Пожалуйста, авторизуйтесь.";
    $logged = false;
    exit;
}



if (isset($_COOKIE['cart'])) {
    if (isset($_POST['submit'])) {
        $cart = explode('.', $_COOKIE['cart']);

        $price = 0;
        foreach ($cart as $item) {
            $query = mysql_query("SELECT * FROM products WHERE products.id = '" . $item . "' LIMIT 1");
            $data = mysql_fetch_assoc($query);
            $price += $data['price'];
        }

        $initials = mysql_real_escape_string($_POST['initials']);
        $email = mysql_real_escape_string($_POST['email']);
        $id = mysql_real_escape_string(intval($_COOKIE['id']));
        $time = intval(time());
        $query = mysql_query("INSERT INTO orders (user_id, unixTime, initials, email, price) VALUES ($id, $time, '$initials', '$email', $price);");
        $lastID = mysql_insert_id();

        foreach ($cart as $item) {
            $query = mysql_query("INSERT INTO ordered (order_id, product_id) VALUES ($lastID, $item)");
        }

        print "Номер вашего заказа: $lastID <br>";
        print "ФИО: " . $initials . "<br>";
        print "Email: " . $email . "<br>";
        print "Время: " . gmdate("Y.m.d в H:i:s", $time) . "<br>";
        print "Стоимость: $price<br>";
    } else {
        print '<form method="POST">
            ФИО <input name="initials" required="required" type="text"><br>
            Email <input name="email" type="email"><br>
            <input name="submit" type="submit" value="Добавить">
            </form>';
    }






} else {
    print "Корзина пуста";
}