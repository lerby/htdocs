<?php
//!!!!!!!!!!!!!!!!!!!!!//// mysql_fetch_assoc
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/left.php';
include_once '../blocks/user_header.php';
?>

<html>
<head>
    <title>Категория</title>

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

    <div id="grid">
        <?php
        $products = products();
        if ($products === false) { ?>
            <div id="grid-selector">Категория пуста! </div>
        <?php }
        else {
        while ($item = mysql_fetch_assoc($products)) {
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
                print '<span class="product_price">' . $item['price'] . '</span>';
                print '<span class="product_name">' . $item['title'] . '</span>';
                print '<p>' . $item['description'] . '</p>';
                print '</div>';
                print '</div>';
                print '</div>';
                print '</div>';
                print '</div>';
            }
        }
        ?>
    </div>


</div>
</body>
</html>
























































