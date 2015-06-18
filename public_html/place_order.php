<?php
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/left.php';
include_once '../blocks/user_header.php';

$result = checkout();
if (count($result) > 0) {
    print 'Ваш заказ принят!<br>';
    print 'Номер вашего заказа: '.$result[0].'<br>';
    print 'ФИО: '.$result[1].'<br>';
    print 'Email: '.$result[2].'<br>';
    print 'Время: '.$result[3].'<br>';
    print 'Стоимость: '.$result[4].'<br>';
}