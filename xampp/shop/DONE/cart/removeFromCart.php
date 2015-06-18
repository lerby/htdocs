<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 22:00
 */

if (isset($_GET['id'])) {
    if (isset($_COOKIE['cart'])) {
        $cart = $_COOKIE['cart'];
        $cart = explode ('.' , $cart);
        if (in_array($_GET['id'], $cart)) {
            $cartString = "";
            for ($i = 0; $i < count($cart); ++$i) {
                if ($cart[$i] != $_GET['id']) {
                    $cartString = $cartString . $cart[$i] . '.';
                }
            }
            $cartString = substr($cartString, 0, -1);
            setcookie("cart", $cartString, time() + 60 * 60 * 24 * 30);
        }
    }
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}