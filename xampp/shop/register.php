<?php
include 'works/classes/MySQL.php';
include 'works/register.php';
include 'works/login.php';
$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');
?>

<html>
<head>
    <title>Главная страница</title>
    <style type="text/css">
        div#block {width:600px; margin:0 auto; background-color:#dddddd}
        div.header {width:600px; height:100px; background-color:#717dc9}
        div.left_col {width:148px; height:350px; float:left; border-right:2px dashed #717dc9}
        div.right_col {width:450px; float:left}
        div.footer {width:600px; height:70px; background-color:#717dc9; clear:both}
    </style>
</head>
<body>
<div id="block">
    <div class="header"><h1 align="center">Интернет магазин</h1></div>
    <div class="left_col">
        <p align="center">Меню</p>
        <?php logination(); ?>

    </div>
    <div class="right_col">
        <h2 align="center"> <?php registration(); ?></h2>
    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>
</html>