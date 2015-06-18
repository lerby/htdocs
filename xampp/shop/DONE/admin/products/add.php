<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 16:23
 */

include '../../classes/MySQL.php';

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
        $category = mysql_real_escape_string($_POST['category']);
        $title = mysql_real_escape_string($_POST['title']);
        $price = mysql_real_escape_string($_POST['price']);
        $photo = mysql_real_escape_string($_POST['photo']);
        $description = mysql_real_escape_string($_POST['description']);

        $query = mysql_query("INSERT INTO products (category_id, title, price, photo_uri, description) VALUES (".$category.", '".$title."',".$price.", '".$photo."', '".$description."')");
        header("Location: delete.php"); exit();

    } else {
        $query = mysql_query("SELECT * FROM categories");

        print '<form method="POST">';
        print 'Категория ';
        print '<select name="category">';
        while ($row = mysql_fetch_assoc($query)) {
            print '<option value="'.$row['id'].'">'.$row['title'].'</option>';
        }
        print '</select><br>';
        print 'Название ';
        print '<input name="title" type="text"><br>';
        print 'Стоимость ';
        print '<input name="price" type="number"><br>';
        print 'Изображение ';
        print '<input name="photo" type="text"><br>';
        print 'Описание ';
        print '<input name="description" type="text"><br>';
        print '<input name="submit" type="submit" value="Добавить">';
        print '</form>';
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