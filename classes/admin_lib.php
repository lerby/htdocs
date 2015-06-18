<?php

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');

$logination = new loginWorker();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $id = mysql_real_escape_string($_COOKIE['id']);
    $hash = mysql_real_escape_string($_COOKIE['hash']);
    $logination->isLoggedIn($id, $hash);
}

if (!$logination->isAdmin) {
    print "REDIRECT TO SOMETHING LIKE 404 PAGE";
    return false;
}

// подтверждение заказов
function confirmOrders() {
    $selected = $_POST['selected'];
    foreach ($selected as $item) {
        $query = mysql_query("UPDATE orders SET progress=0 WHERE id=" . mysql_real_escape_string($item));
    }
    return true;
}

// отмена заказов
function cancelOrders() {
    $selected = $_POST['selected'];
    foreach ($selected as $item) {
        $query = mysql_query("UPDATE orders SET progress=2 WHERE id=" . mysql_real_escape_string($item));
    }
    return true;
}

// Список заказов если id = false
function order($id = false) {
    if ($id === false) {
        $result = mysql_query("SELECT * FROM orders");
        return $result;
    }
    else {
        $id = mysql_real_escape_string($_GET['id']);
        $orderQuery = mysql_query("SELECT * FROM orders WHERE id=$id LIMIT 1");
        return $orderQuery;
    }
}

// Если пользователь заблокирован - разблокирует
// Если пользователь разблокирован - заблокирует
function reverseUserStatus($ids = false) {
    if (isset($_POST['selected'])) $ids = $_POST['selected'];
    if (count($ids) === 0) return false;

    foreach ($ids as $item) {
        $query = mysql_query("SELECT blocked FROM users WHERE id=".mysql_real_escape_string($item)." LIMIT 1");
        $row = mysql_fetch_assoc($query);
        if ($row['blocked'] === '0')
            $query = mysql_query("UPDATE users SET blocked=1 WHERE id=".mysql_real_escape_string($item));
        else
            $query = mysql_query("UPDATE users SET blocked=0 WHERE id=".mysql_real_escape_string($item));
    }
    return true;
}

// Список пользователей
function users() {
    $result = mysql_query("SELECT * FROM users");
    return $result;
}

// Удалание продуктов
function removeProduct($ids = false) {
    if (isset($_POST['selected'])) $ids = $_POST['selected'];

    if (count($ids) === 0) return false;

    foreach ($ids as $item) {
        $query = mysql_query("DELETE FROM products WHERE id=".mysql_real_escape_string($item));
    }
    return true;
}

// Добавление продукта
function addProduct() {
    if (isset($_POST['category']) && isset($_POST['title']) &&
        isset($_POST['price']) && isset($_POST['photo']) && isset($_POST['description'])) {
        $category = mysql_real_escape_string($_POST['category']);
        $title = mysql_real_escape_string($_POST['title']);
        $price = mysql_real_escape_string($_POST['price']);
        $photo = mysql_real_escape_string($_POST['photo']);
        $description = mysql_real_escape_string($_POST['description']);

        if (!isset($_POST['photo'])) {
            $photo = 'http://i.imgur.com/SX7JcTS.jpg';
        }

        $query = mysql_query("INSERT INTO products (category_id, title, price, photo_uri, description) VALUES (" . $category . ", '" . $title . "'," . $price . ", '" . $photo . "', '" . $description . "')");
        return $query;
    }
    return false;
}

function removeCategory($ids = false) {
    if (isset($_POST['selected'])) $ids = $_POST['selected'];

    if (count($ids) === 0) return false;

    foreach ($ids as $item) {
        $query = mysql_query("DELETE FROM categories WHERE id=".mysql_real_escape_string($item));
    }
    return true;
}

// Добавление продукта
function addCategory() {
    if (isset($_POST['title'])) {
        $title = mysql_real_escape_string($_POST['title']);
        $query = mysql_query("INSERT INTO categories (title) VALUES ('" . $title . "')");
        $lastID = mysql_insert_id();
        return $query;
    }
    return false;
}



































































