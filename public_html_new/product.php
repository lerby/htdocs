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
    <script src="js/cart-2.js"></script>
</head>
<body>
<div id="block">
    <?php printHeader(); ?>
    <div class="left_col">
        <?php leftBlocks(); ?>
    </div>
    <div class="right_col">
        <div class="wrapper grid3">
            <?php $product = product();
            if ($product !== false) {
                $product = mysql_fetch_assoc($product);
                print '<div>'.$product['title'].' ('.$product['price'].')'.'</div>';
                // print '<div>Стоимость: '.$product['price'].'</div>';
                print '<div style="float:right;">'.$product['description'].'</div>';
                print '<div style="float:left;"><img src="'.$product['photo_uri'].'" width="250px"></div>';
            }
            ?>
        </div>

        <div class="wrapper grid3">
            <?php
            $recomendations = recomendations();
            if ($recomendations === false) { ?>
                Популярных товаров нет!
            <?php }
            else {
                foreach ($recomendations as $element) {
                    $item = mysql_fetch_assoc($element);?>
                    <div class="featured col">
                        <h3><?php print '<a href="product.php?id='.$item['id'].'">'.$item['title'].'</a>'; ?></h3>
                        <img src="<?php print $item['photo_uri']; ?>" />
                        <p>Стоимость: <?php print $item['price']; ?></p>
                        <!-- <p><a href="cart/addToCart.php?id=<?php //print $item['id']; ?>">Add to cart</a></p> -->
                        <p><a href="javascript:addToCart(<?php print $item['id']; ?>)">Add to cart</a></p>
                    </div>

                <?php }} ?>
        </div>


    </div>
    <div class="footer"><p>FOOTER</p></div>
</div>
</body>
</html>
























































