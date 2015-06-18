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
    <script src="../js/orders.js"></script>
    <script src="../js/list.js"></script>
</head>
<body>
<div id="block">
    <?php printAdminHeader() ?>
    <div class="right_col">
        <div class="wrapper grid3">
            <div id="orders">
                <?php

                $order = order();
                if ($order !== false) {
                    print '<input class="search" placeholder="Search"/><br><br>';
                    print '<form method="POST" id="orders_form">
                    <table>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>ФИО</th>
                        <th>Email</th>
                        <th>Дата</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                        <!--<th></th>-->
                    </tr>';
                    print '<tbody class="list">';
                    while ($row = mysql_fetch_assoc($order)) {
                        print '<tr>';
                        print '<td>' . '<input type="checkbox" name="selected[]" value="' . $row['id'] . '">' . '</td>';
                        print '<td class="id">' . $row['id'] . '</td>';
                        print '<td class="fio">' . $row['initials'] . '</td>';
                        print '<td class="email">' . $row['email'] . '</td>';
                        print '<td class="time">' . gmdate("Y.m.d в H:i:s", $row['unixTime']) . '</td>';
                        print '<td class="price">' . $row['price'] . '</td>';
                        $progress = "";
                        if ($row['progress'] == 0)
                            $progress = "Отменен";
                        elseif ($row['progress'] == 1)
                            $progress = "Не подтвержден";
                        elseif ($row['progress'] == 2)
                            $progress = "Подтвержден";

                        print '<td class="progress">'.$progress.'</td>';
                        //print '<td><a href="?id=' . $row['id'] . '">Перейти</a></td>';
                        print '</tr>';
                    }
                    print '</tbody></table>';

                    print "<script>
                            var options = {
                              valueNames: [ 'id', 'fio', 'email', 'time', 'price', 'progress' ]
                            };

                            var userList = new List('orders', options);

                            </script>";

                    print '<div style="float:left;">
                            <input type="radio" name="action" value="cancel">Подтвердить<br>
                            <input type="radio" name="action" value="confirm">Отменить
                            </div><div style="float:left;">
                            <input name="submit" type="submit" value="Выполнить">
                            </div></form>';
                }
                else {
                    print "Нету заказов!";
                }

                ?>
                <div id="status"></div>
            </div>
            <br><br>





        </div>
    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>