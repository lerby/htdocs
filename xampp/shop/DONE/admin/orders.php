<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 26.05.2015
 * Time: 10:16
 */

include '../classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');
$permission = 0;
$logged = false;

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
    if (!isset($_GET['id'])) {
        $query = mysql_query("SELECT * FROM orders");
        print '<form method="POST">
        <table>
            <tr>
                <th></th>
                <th>#</th>
                <th>ФИО</th>
                <th>Email</th>
                <th>Дата</th>
                <th>Сумма</th>
                <th>Статус</th>
                <th></th>
            </tr>';

        while ($row = mysql_fetch_assoc($query)) {
            print '<tr>';
            print '<td>' . '<input type="checkbox" name="selected[]" value="' . $row['id'] . '">' . '</td>';
            print '<td>' . $row['id'] . '</td>';
            print '<td>' . $row['initials'] . '</td>';
            print '<td>' . $row['email'] . '</td>';
            print '<td>' . gmdate("Y.m.d в H:i:s", $row['unixTime']) . '</td>';
            print '<td>' . $row['price'] . '</td>';
            if ($row['progress'] == 0)
                print '<td>Отменен</td>';
            elseif ($row['progress'] == 1)
                print '<td>Не подтвержден</td>';
            elseif ($row['progress'] == 2)
                print '<td>Подтвержден</td>';
            print '<td><a href="orders.php?id='.$row['id'].'">Перейти</a></td>';
            print '</tr>';
        }

        print '</table><input name="cancel" type="submit" value="Отменить"> <input name="confirm" type="submit" value="Подтвердить"></form>';


        if (isset($_POST['cancel'])) {
            $selected = $_POST['selected'];
            foreach ($selected as $item) {
                $query = mysql_query("UPDATE orders SET progress=0 WHERE id=" . mysql_real_escape_string($item));
            }
        } elseif (isset($_POST['confirm'])) {
            $selected = $_POST['selected'];
            foreach ($selected as $item) {
                $query = mysql_query("UPDATE orders SET progress=2 WHERE id=" . mysql_real_escape_string($item));
            }
        }

    } else {
        $id = mysql_real_escape_string($_GET['id']);
        $orderQuery = mysql_query("SELECT * FROM orders WHERE id=$id LIMIT 1");
        if (mysql_num_rows($orderQuery) === 0) {
            print "Нет такого заказа";
            exit;
        }

        $orderData = mysql_fetch_assoc($orderQuery);
        $orderID = $orderData['id'];
        $productsQuery = mysql_query("SELECT * FROM ordered WHERE order_id=$orderID");

        print "ФИО: ".$orderData['initials']."<br>";
        print "Email: ".$orderData['email']."<br>";
        print "Price: ".$orderData['price']."<br>";
        print "Время: " . gmdate("Y.m.d в H:i:s", $orderData['unixTime']) . "<br>";
        print "<br>";

        print '<table><tr><th colspan="2">Заказанные товары</th></tr><tr><th>Название</th><th>Стоимость</th></tr>';
        while ($row = mysql_fetch_assoc($productsQuery)) {
            $productID = $row['product_id'];
            $product = mysql_query("SELECT * FROM products WHERE id=$productID");
            if ($product !== false) {
                $product = mysql_fetch_assoc($product);
                print "<tr>";
                print "<td>".$product['title']."</td>";
                print "<td>".$product['price']."</td>";
                print "</tr>";
            }
        }
        print "</table>";


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

