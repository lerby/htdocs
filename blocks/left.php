<?php
include_once '../classes/user_lib.php';
function leftBlocks() {
    $cart = getCartData();
    ?>


    <div class="cart-icon-top">
    </div>

    <div class="cart-icon-bottom">
    </div>

    <div id="checkout">
        <a href="checkout.php" style="color: #5ff7d2; text-decoration: none;">СДЕЛАТЬ ЗАКАЗ</a>
    </div>

        <?php if (count($cart) > 0) {?>
            <script>
                $("#checkout").fadeIn(500);
            </script>
        <?php } ?>

    <div id="sidebar">
    <h3>КОРЗИНА</h3>
    <div id="cart">

        <?php
        $price = 0;
        if (count($cart) === 0)
            print '<span class="empty">Корзина пуста :(.</span>';
        else
            print '<span class="empty" style="display: none;">Корзина пуста :(.</span>';
            for ($i = 0; $i < count($cart); ++$i) {

                print '<div class="cart-item">';
                print '<div class="img-wrap">';
                print '<img src="' . $cart[$i]['photo_uri'] . '" alt>';
                print '</div>';
                print '<span>' . $cart[$i]['title'] . '</span>';
                print '<strong> $' . $cart[$i]['price'] . '</strong>';
                print '<div class="cart-item-border"></div>';
                print '<div class="delete-item"><a href="javascript:removeFromCart('.$cart[$i]['id'].')"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/delete-item.png"></a></div>';
                print '</div>';


        } ?>

        <!--print '<a href="product.php?id=' . $cart[$i]['id']. '">'.$cart[$i]['title'].'</a>';
        print ' ('.$cart[$i]['price'].')';
        print ' ('.'<a href="javascript:removeFromCart('.$cart[$i]['id'].')">X</a>'.')';
        print '<br>';
        $price = $price + $cart[$i]['price'];-->

    </div>

    <h3>КАТЕГОРИИ</h3>
    <div class="checklist categories">
        <ul>
            <?php
            $categories = category();
            while ($item = mysql_fetch_assoc($categories)) {
                print '<li><a href="category.php?id=' . $item['id']. '">'.$item['title'].'</a></li>';
            }
            ?>
        </ul>
    </div>

    <h3>ПОЛЬЗОВАТЕЛЬ</h3>
    <div id="login_box_form">
        <?php
        $logination = $GLOBALS['logination'];
        print '<p style="font-size: 15px; padding: 3px; color: #b1b1b3;">';
        if (isLogged()) {
            print "Вы вошли как ".$logination->userName."!<br>";
            if ($logination->isAdmin) {
                print '<a href="admin" style="color: #2aa9e0; text-decoration: none;">Админка</a><br><br>';
            }
            print '<a style="color: #ea4c89; text-decoration: none;" href="javascript:logOut()">Выйти</a>';
        } else {?>

                <div id="error"></div>

                <form class="msform" style="width:90%;" data-ajax="true" method="POST" id="login_form">
                    <input style="width:90%" type="text" name="login" placeholder="Логин" />
                    <input style="width:90%"type="password" name="password" placeholder="Пароль" />
                    <input name="submit" type="submit" id="submit" value="Войти" class="submit action-button"/>
                </form>
                <!--<form method="POST" id="login_form">
                    <label for="username">Логин:</label>
                    <input size="14" name="login" type="text" id="username" value=""/><br/>
                    <label for="password">Пароль:</label>
                    <input size="14" name="password" type="password" id="password" value=""/><br/>
                    <input name="submit" type="submit" id="submit" value="Войти" />
                </form>-->

        <?php
            print '</p>';
            }
        ?>
    </div>

</div>

<?php }?>



<?php


function printCart() {
    $cart = getCartData();
    $price = 0;
    if (count($cart) === 0)
        print '<span class="empty">Корзина пуста :(.</span>';
    else
        print '<span class="empty" style="display: none;">Корзина пуста :(.</span>';
        for ($i = 0; $i < count($cart); ++$i) {

            print '<div class="cart-item">';
            print '<div class="img-wrap">';
            print '<img src="' . $cart[$i]['photo_uri'] . '" alt>';
            print '</div>';
            print '<span>' . $cart[$i]['title'] . '</span>';
            print '<strong> $' . $cart[$i]['price'] . '</strong>';
            print '<div class="cart-item-border"></div>';
            print '<div class="delete-item"><a href="javascript:removeFromCart('.$cart[$i]['id'].')"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/delete-item.png"></a></div>';
            print '</div>';


        }
}
?>