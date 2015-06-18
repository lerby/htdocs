<?php

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');

$logination = new loginWorker();
isLogged();

if ($logination->blocked) return false;

// Название категории, если c_id = false, то весь список
function category($c_id = false) {
    if ($c_id === false) {
        $query = mysql_query("SELECT * FROM categories");
        return ($query);
    }
    else {
        $categoryTitle = mysql_query("SELECT * FROM categories WHERE id = '".intval($c_id)."' LIMIT 1");
        return ($categoryTitle);
    }
}

// Товар категории, если c_id = false, то весь товар
function products() {
    if (isset($_GET['id']) === false) {
        $productDetails = mysql_query("SELECT * FROM products");
        if (mysql_num_rows($productDetails) === 0)
            return false;
        return ($productDetails);
    }

    else {
        $productDetails = mysql_query("SELECT * FROM products WHERE category_id = ".intval($_GET['id']));
        if (mysql_num_rows($productDetails) === 0)
            return false;
        return ($productDetails);
    }
}

// Возвращает все данные о товаре
function product($p_id = false) {
    if (isset($_GET['id']) !== false && $p_id === false) {
        $p_id = $_GET['id'];
    }

    $productDetails = mysql_query("SELECT * FROM products WHERE id = ".intval($p_id)." LIMIT 1");
    if (mysql_num_rows($productDetails) === 0)
        return false;
    return ($productDetails);

}

// Вход в логин
function logIn() {
    $err = array();
    $logination = $GLOBALS['logination'];

    if (isLogged()) return true;


    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = mysql_real_escape_string($_POST['login']);
        $password = mysql_real_escape_string($_POST['password']);

        if ($logination->logIn($login, $password)) {
            setcookie("id", $logination->id, time() + 60 * 60 * 24 * 30, '/');
            setcookie("hash", $logination->hash, time() + 60 * 60 * 24 * 30, '/');
            return true;
        }

        if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
        }

        if (strlen($login) < 3 or strlen($login) > 30) {
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        }

        $query = mysql_query("SELECT COUNT(id) FROM users WHERE login='" . $login . "'");

        if (mysql_result($query, 0) > 0) {
            $err[] = "Пользователь с таким логином уже существует в базе данных";
        }

        if (count($err) === 0) {
            $passwordHash = md5(md5(trim($password)));
            mysql_query("INSERT INTO users SET login='" . $login . "', password='" . $passwordHash . "'");

            $lastID = mysql_insert_id();

            if ($logination->logIn($login, $password)) {
                setcookie("id", $logination->id, time() + 60 * 60 * 24 * 30, '/');
                setcookie("hash", $logination->hash, time() + 60 * 60 * 24 * 30, '/');
                return true;
            }

            return true;
        }
        else {
            return false;
        }
    }

    return false;
}

// Проверка залогинен ли пользователь
function isLogged() {
    $logination = $GLOBALS['logination'];

    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $id = mysql_real_escape_string($_COOKIE['id']);
        $hash = mysql_real_escape_string($_COOKIE['hash']);
        $logination->isLoggedIn($id, $hash);
    }

    return $logination->isLogged;
}

// Возвращает массив с товарами корзины
function getCartData() {
    $items = array();

    if (isset($_COOKIE['cart'])) {
        $cart = explode (',' , $_COOKIE['cart']);

        foreach ($cart as $item) {
            $query = mysql_query("SELECT * FROM products WHERE products.id = '".$item."' LIMIT 1");
            $data = mysql_fetch_assoc($query);
            array_push($items, $data);
        }
    }

    return $items;
}

// Заказ товара
function checkout() {
    $logination = $GLOBALS['logination'];
    if (!$logination->isLogged) return array();
    // if (!isLogged()) return array();

    $cart = getCartData();
    if (count($cart) === 0) return array();

    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['mname']) && isset($_POST['email'])) {
        $price = 0;
        foreach ($cart as $item) {
            $price = $price + $item['price'];
        }
        $id = mysql_real_escape_string(intval($_COOKIE['id']));
        $initials = mysql_real_escape_string($_POST['lname'].' '.$_POST['fname'].' '.$_POST['mname']);
        $email = mysql_real_escape_string($_POST['email']);
        $time = intval(time());

        if (strlen($initials) === 0 || strlen($email) === 0 || strlen($id) === 0)
            return array();

        $query = mysql_query("INSERT INTO orders (user_id, unixTime, initials, email, price) VALUES ($id, $time, '$initials', '$email', $price);");
        $lastID = mysql_insert_id();

        foreach ($cart as $item) {
            $id = $item['id'];
            $query = mysql_query("INSERT INTO ordered (order_id, product_id) VALUES ($lastID, $id)");
        }

        return array($lastID, $initials, $email, gmdate("Y.m.d в H:i:s", $time), $price);
    }
    else {
        return array();
    }
}

// Популярные товары
function popularProducts() {
    $query = mysql_query("SELECT count(product_id), product_id FROM ordered GROUP BY product_id ORDER BY count(product_id);");
    $result = array();
    $i = 0;
    while (($item = mysql_fetch_assoc($query)) && ($i < 3)) {
        $product = product($item['product_id']);
        array_push($result, $product);
        ++$i;
    }
    return $result;
}

// Рекомендации к товару
function recomendations($p_id = false) {
    if (isset($_GET['id']) !== false) {
        $p_id = $_GET['id'];
    }
    $query = mysql_query("SELECT order_id FROM ordered WHERE product_id=".$p_id.";");
    $random = rand(0, mysql_num_rows($query) - 1);
    $i = 0;
    $count = 0;
    $result = array();
    while ($item = mysql_fetch_assoc($query)) {
        if ($i === $random) {
            $query = mysql_query("SELECT product_id FROM ordered WHERE order_id=".$item['order_id'].";");
            while (($element = mysql_fetch_assoc($query)) && ($count < 3)) {
                $product = product($element['product_id']);
                array_push($result, $product);
                ++$count;
            }
        }
        ++$i;
    }

    return $result;
}

// Строгий поиск по названию
function search($word = false) {
    if (isset($_GET['search'])) $word = $_GET['search'];
    if ($word === false) return;

    $queryStr = "SELECT * FROM products WHERE title LIKE '%".$word."%';";
    $query = mysql_query($queryStr);
    return $query;
}


















