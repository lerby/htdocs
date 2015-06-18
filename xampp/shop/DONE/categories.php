<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 23:44
 */

include 'classes/MySQL.php';

if (isset($_GET['id'])) {
    $productDetails = mysql_query("SELECT * FROM products WHERE category_id = ".intval($_GET['id']));
    if (mysql_num_rows($productDetails) == 0) {
        print "Категория пуста";
        exit;
    }
    $categoryTitle = mysql_query("SELECT * FROM categories WHERE id = '".intval($_GET['id'])."' LIMIT 1");
    $categoryTitle = mysql_fetch_assoc($categoryTitle);

    while ($row = mysql_fetch_assoc($productDetails)) {
        print '<a href="product.php?id=' . $row['id']. '">'.$row['title'].'</a><br>';
    }


    /*print '<img src="'.$productDetails['photo_uri'].'" width="100px"><br>';
    print "Категория: ";
    print $categoryTitle['title']."<br>";
    print "Название: ";
    print $productDetails['title']."<br>";
    print "Стоимость: ";
    print $productDetails['price']."<br>";
    print "Описание: ";
    print $productDetails['description']."<br>";
    print '<a href="cart/addToCart.php?id='.$_GET["id"].'">Add to cart</a>';*/
}
else {
    $query = mysql_query("SELECT * FROM categories");
    while ($row = mysql_fetch_assoc($query)) {
        print '<a href="categories.php?id=' . $row['id']. '">'.$row['title'].'</a><br>';
    }
}
