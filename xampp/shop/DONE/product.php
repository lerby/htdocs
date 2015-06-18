<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 19:53
 */

include 'classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');

if (isset($_GET['id'])) {
    $productDetails = mysql_query("SELECT * FROM products WHERE id = ".intval($_GET['id'])." LIMIT 1");
    if (mysql_num_rows($productDetails) == 0) {
        print "id предмета не существует";
        exit;
    }
    $productDetails = mysql_fetch_assoc($productDetails);
    $categoryTitle = mysql_query("SELECT * FROM categories WHERE categories.id = '".$productDetails['category_id']."' LIMIT 1");
    $categoryTitle = mysql_fetch_assoc($categoryTitle);


    print '<img src="'.$productDetails['photo_uri'].'" width="100px"><br>';
    print "Категория: ";
    print $categoryTitle['title']."<br>";
    print "Название: ";
    print $productDetails['title']."<br>";
    print "Стоимость: ";
    print $productDetails['price']."<br>";
    print "Описание: ";
    print $productDetails['description']."<br>";
    print '<a href="cart/addToCart.php?id='.$_GET["id"].'">Add to cart</a>';
}
else {
    $query = mysql_query("SELECT * FROM products");
    while ($row = mysql_fetch_assoc($query)) {
        print '<a href="product.php?id=' . $row['id']. '">'.$row['title'].'</a><br>';
    }
}
