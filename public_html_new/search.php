<?php
//!!!!!!!!!!!!!!!!!!!!!//// mysql_fetch_assoc
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/left.php';
include_once '../blocks/user_header.php';
?>

<!--
function category($c_id);
function products($c_id = false);
function product($p_id);
function logIn();
function isLogged();
function getCartData();
function checkout();
-->




<html>
<head>
    <title>Главная страница</title>

    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/search.js"></script>
</head>
<body>
<div id="block">
    <?php printHeader(); ?>
    <div class="left_col">

        <?php leftBlocks(); ?>

    </div>
    <div class="right_col">
        <div>
            <form method="GET" id="search_form">
                Поиск: <br><input name="search" type="text">
                <input name="submit" type="submit" value="Найти!">
            </form>
        </div>

        <div id="result">
            <?php
            if (isset($_GET['search']) && !(strlen($_GET['search']) <= 0)) {

                print '<div class="wrapper grid3">';
                $result = search();
                if ($result === false) {
                    //print "Ничего не найдено!";
                }
                else {
                    if (!isset($_GET['page'])) {
                        while ($item = mysql_fetch_assoc($result)) {
                            print '<div class="featured col">';
                            print '<h3><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></h3>';
                            print '<img src="' . $item['photo_uri'] . '" />';
                            print '<p>Стоимость: ' . $item['price'] . '</p>';
                            print '<p><a href="javascript:addToCart(' . $item['id'] . ')">Add to cart</a></p>';
                            print '</div>';
                        }
                    }
                    else {
                        print '<div>';
                        $count = 1;
                        $page = $_GET['page'];
                        while ($item = mysql_fetch_assoc($result)) {
                            if ($count > $page * 3 - 3 && $count <= $page * 3) {
                                print '<div class="featured col">';
                                print '<h3><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></h3>';
                                print '<img src="' . $item['photo_uri'] . '" />';
                                print '<p>Стоимость: ' . $item['price'] . '</p>';
                                print '<p><a href="javascript:addToCart(' . $item['id'] . ')">Add to cart</a></p>';
                                print '</div>';
                            }
                            ++$count;
                        }
                        print '</div>';


                        print '<div>';
                        $count = mysql_num_rows($result);
                        print '<br>Найдено '.$count.'<br><br>';
                        $i = $count / 3;
                        $j = 1;
                        while ($i > 0) {
                            print '<a href="search.php?search='.$_GET['search'].'&page='.$j.'">'.$j.'</a> ';
                            ++$j;
                            --$i;
                        }
                        print '</div>';
                    }
                }
                print '</div>';
            }
            else {
                //print 'Пустая строка поиска!';
            }
            ?>
        </div>




    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>
</html>
























































