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
    <title>Заказ</title>

    <link href="css/styles-2.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.min.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/cart-2.js"></script>
    <script src="js/login.js"></script>

    <script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

</head>
<body>
<div id="wrapper">
    <?php printHeader(); ?>
    <?php leftBlocks(); ?>



    <div id="grid" style="top:100px;">
        <!-- multistep form -->
        <form id="msform" class="msform" data-ajax="true" method="POST">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Список товаров</li>
                <li>Социальные сети</li>
                <li>Персональная информация</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <?php
                $logination = $GLOBALS['logination'];
                if ($logination->blocked) {
                    print 'К сожалению, вы заблокированы.';
                } else {?>
                <h2 class="fs-title" > Список товаров </h2 >
                <?php printCart(); ?>
                <input type="button" name="next" class="next action-button" value="Дальше" />
                <?php } ?>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Социальные сети</h2>
                <input type="text" name="twitter" placeholder="Twitter" />
                <input type="text" name="facebook" placeholder="Facebook" />
                <input type="text" name="gplus" placeholder="Google Plus" />
                <input type="button" name="previous" class="previous action-button" value="Назад" />
                <input type="button" name="next" class="next action-button" value="Дальше" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Персональная информация</h2>
                <input type="text" name="fname" id="fname" placeholder="Имя" minlength=2 required />
                <input type="text" name="lname" id="lname" placeholder="Фамилия" minlength=2 required />
                <input type="text" name="mname" id="mname" placeholder="Отчество" minlength=2 required />
                <input type="email" name="email" id="email" placeholder="Email" minlength=2 required />
                <input type="button" name="previous" class="previous action-button" value="Назад" />
                <input type="submit" name="submit" class="submit action-button" value="Отправить" />
            </fieldset>
        </form>

        <script src="js/checkout-2.js"></script>
    </div>
</div>


<div id="block">

    <div class="right_col">
        <div class="wrapper grid3">
            <div id="error"></div>
            <div id="order_block">
                <form method="POST" id="checkout_form">
                    ФИО <input name="initials" required="required" type="text"><br>
                    Email <input name="email" type="email"><br>
                    <input name="submit" type="submit" value="Сделать заказ!">
                </form>
            </div>
        </div>

    </div>
</div>
</body>
</html>
























































