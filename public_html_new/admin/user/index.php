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
    <script src="../js/users.js"></script>
</head>
<body>
<div id="block">
    <?php printAdminHeader() ?>
    <div class="right_col">
        <div class="wrapper grid3">
            <div id="status"></div>
            <?php

            $users = users();
            if (count($users) !== 0) {
                print '<form method="POST" id="users_form">
                <table>
                <tr>
                    <th></th>
                    <th>Логин</th>
                    <th>Заблокирован</th>
                </tr>';

                while ($row = mysql_fetch_assoc($users)) {
                    print '<tr>';
                    print '<td>';
                    print '<input type="checkbox" name="selected[]" value="' . $row['id'] . '">';
                    print '</td>';
                    print '<td>';
                    print $row['login'];
                    print '</td>';
                    print '<td>';
                    if ($row['blocked'] == 0)
                        print "Нет";
                    else
                        print "Да";
                    print '</td>';
                    print '</tr>';
                }

                print '</table><input name="submit" type="submit" value="Заблокировать/Разблокировать"></form>';
            }
            else {
                print "Нет пользователей!";
            }
            ?>



        </div>
    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>