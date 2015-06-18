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
    <script src="../js/categories.js"></script>
</head>
<body>
<div id="block">
    <?php printAdminHeader() ?>
    <div class="right_col">
        <div class="wrapper grid3">

            <div id="status"></div>

            <div>
            <?php

            $categories = category();

            if ($categories !== false) {
                print '<form method="POST" id="categories_form">
                <table>
                <tr>
                    <th></th>
                    <th>Название</th>
                </tr>';

                while ($row = mysql_fetch_assoc($categories)) {
                    print '<tr>';
                    print '<td>';
                    print '<input type="checkbox" name="selected[]" value="' . $row['id'] . '">';
                    print '</td>';
                    print '<td>';
                    print $row['title'];
                    print '</td>';
                    print '</tr>';
                }

                print '</table><input name="submit" type="submit" value="Удалить"></form>';
            }
            else {
                print "Категорий нет";
            }
            ?>
            </div>
            <br><br><br><br>
            <div>
                <form method="POST" id="add_category">
                    Название категории <br><input name="title" type="text"><br>
                    <input name="submit" type="submit" value="Добавить">
                </form>
            </div>
            <br><br><br><br>





        </div>
    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>