<?php include_once '../../../classes/MySQL.php';
include_once '../../../classes/login.php';
include_once '../../../classes/admin_lib.php';
include_once '../../../classes/user_lib.php';

if (reverseUserStatus())
    print 'ok';
?>