<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 21:31
 */

if (isset($_GET['id'])) {
    if (isset($_COOKIE['cart'])) {
        $cart = $_COOKIE['cart'];
        $cart = explode ('.' , $cart);
        if (!in_array($_GET['id'], $cart)) {
            array_push($cart, $_GET['id']);
            $cartString = "";

            for ($i = 0; $i < count($cart); ++$i) {
                $cartString .= $cart[$i];
                if ($i != count($cart) - 1)
                    $cartString .= '.';
            }
            setcookie("cart", $cartString, time() + 60 * 60 * 24 * 30);
        }
    } else {
        setcookie("cart", $_GET['id'], time()+60*60*24*30);
    }
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}