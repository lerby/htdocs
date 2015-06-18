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
    <title>Поиск</title>

    <link href="css/styles-2.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.min.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/cart-2.js"></script>
    <script src="js/login.js"></script>
</head>
<body>
<div id="wrapper">
    <?php printHeader(); ?>
    <?php leftBlocks(); ?>
    <?php
    if (isset($_GET['search']) && (strlen($_GET['search']) > 0)) {
        $result = search();
        $count = mysql_num_rows($result);
    }
    ?>

    <div id="grid-selector">
        <form method="GET" id="search_form" action="search.php">
            Поиск: <input name="search" type="text">
            <input name="page" type="text" value="1" style="display:none;">
            <input type="submit" value="Найти!">
        </form>
        <!--Всего найдено <?php print $count; ?><br>-->

        Страницы:
            <?php
            $i = $count / 3;

            $j = 1;
            while ($i > 0) {
                print '<a href="search.php?search=' . $_GET['search'] . '&page=' . $j . '">' . $j . '</a> ';
                ++$j;
                --$i;
            }
            ?>


    </div>

    <div id="grid">

        <?php
        if (isset($_GET['search']) && (strlen($_GET['search']) > 0)) {
            if ($result === false) {
                print "Ничего не найдено :(";
            }
            else {
                if (!isset($_GET['page']))
                    $page = 1;
                else
                    $page = $_GET['page'];

                $count = 0;

                while ($item = mysql_fetch_assoc($result)) {
                    ++$count;
                    if ($count > ($page * 3 - 3) && $count <= ($page * 3)) {
                        print '<div class="product">';
                        print '<div class="make3D">';
                        print '<div class="product-front">';
                        print '<div class="shadow"></div>';
                        print '<img src="' . $item['photo_uri'] . '" alt="" />';
                        print '<div class="image_overlay"></div>';
                        print '<div class="add_to_cart"><a id="classLink" href="javascript:addToCart(' . $item['id'] . ')">В корзину</a></div>';
                        print '<div class="view_gallery">Подробнее</div>';
                        print '<div class="stats">';
                        print '<div class="stats-container">';
                        print '<span class="product_price">$' . $item['price'] . '</span>';
                        print '<span class="product_name">' . $item['title'] . '</span>';
                        print '<p>' . $item['description'] . '</p>';
                        print '</div></div></div></div></div>';
                    }
                }
            }
        }?>
    </div>



</div>
</body>
</html>
























































