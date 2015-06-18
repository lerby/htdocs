<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 21:59
 */

include '../classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');

if (isset($_COOKIE['cart'])) {
    $cart = explode ('.' , $_COOKIE['cart']);
    $price = 0;
    print '<table><tr>
        <th>Название</th>
        <th>Стоимость</th>
        <th></th>
        </tr>';

    foreach ($cart as $item) {
        $query = mysql_query("SELECT * FROM products WHERE products.id = '".$item."' LIMIT 1");
        $data = mysql_fetch_assoc($query);
        print '<tr>';
        print '<td>'.$data['title'].'</td>';
        print '<td>'.$data['price'].'</td>';
        $price += $data['price'];
        print '<td><a href="removeFromCart.php?id='.$item.'">Удалить</td>';
        print '</tr>';
    }
    print '<tr><td>Итог:</td>';
    print '<td>'.$price.'</td>';
    print '<td>Заказать</td>';
    print '</tr></table>';



} else {
    print "Корзина пуста";
}