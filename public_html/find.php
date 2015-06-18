<?php
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/user_header.php';
?>
<?php
if (isset($_GET['search']) && !(strlen($_GET['search']) <= 0)) {

    print '<div class="wrapper grid3">';
    $result = search();
    if ($result === false) {
        print "Ничего не найдено!";
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


            $count = mysql_num_rows($result);
            print 'Найдено '.$count.'<br>';
            $i = $count / 3;
            $j = 1;
            while ($i > $j) {
                print '<a href="'.$_GET['search'].'">'.$j.'</a>';
                --$i;
            }
        }
    }
    print '</div>';
}
else {
    print 'Пустая строка поиска!';
}
?>

