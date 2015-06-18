<?php include_once '../../../classes/MySQL.php';
include_once '../../../classes/login.php';
include_once '../../../classes/admin_lib.php';
include_once '../../../classes/user_lib.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'cancel') {
        print 'cancel done';
        cancelOrders();
    }
    else if ($_POST['action'] === 'confirm') {
        print 'confirm done';
        confirmOrders();
    }
}

//print 'ok';