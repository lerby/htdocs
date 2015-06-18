<?php include_once '../../../classes/MySQL.php';
include_once '../../../classes/login.php';
include_once '../../../classes/admin_lib.php';
include_once '../../../classes/user_lib.php';
include_once '../../../blocks/admin_header.php';?>


<html>
<head>
    <title>Главная страница</title>

    <link href="../../css/styles.css" rel="stylesheet" type="text/css" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/products.js"></script>
</head>
<body>
<div id="block">
    <?php printAdminHeader() ?>
    <div class="right_col">
        <div class="wrapper grid3">

            <div id="status"></div>

            <div>
                <?php


                $categories = products();
                if ($categories !== false) {
                    print '<form method="POST" id="products_form">
                    <table>
                    <tr>
                        <th></th>
                        <th>Категория</th>
                        <th>Название</th>
                        <th>Стоимость</th>
                        <th>Описание</th>
                    </tr>';
                    while ($row = mysql_fetch_assoc($categories)) {
                        print '<tr>';
                        print '<td>'.'<input type="checkbox" name="selected[]" value="' . $row['id'] . '">'.'</td>';
                        $query2 = mysql_query("SELECT * FROM categories WHERE categories.id = '".$row['category_id']."' LIMIT 1");
                        $category_data = mysql_fetch_assoc($query2);
                        print '<td>'. $category_data['title'] .'</td>';
                        print '<td>'. $row['title'] .'</td>';
                        print '<td>'. $row['price'] .'</td>';
                        print '<td>'. $row['description'] .'</td>';
                        print '</tr>';
                    }

                    print '</table><input name="submit" type="submit" value="Удалить"></form>';

                }
                else {
                    print "Товаров нет!";
                }
                ?>
            </div>
            <br><br><br><br>
            <div>
                <form method="POST" id="add_product">
                    Категория<br>
                    <select name="category">
                        <?php
                        $categories = category();
                        while ($row = mysql_fetch_assoc($categories)) {
                            print '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                        }
                        ?>
                    </select><br>
                    Название<br>
                    <input name="title" type="text"><br>
                    Стоимость<br>
                    <input name="price" type="number"><br>
                    Изображение<br>
                    <input name="photo" type="text"><br>
                    Описание<br>
                    <input name="description" type="text"><br>
                    <input name="submit" type="submit" value="Добавить">
                </form>
            </div>
            <br><br><br><br>





        </div>
    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>