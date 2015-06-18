<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 26.05.2015
 * Time: 8:47
 */

include '../classes/MySQL.php';

$sql = new MySQL('127.0.0.1', 'root', '', 'a_shop');

$query = mysql_query("SELECT count(product_id), product_id FROM ordered GROUP BY product_id ORDER BY count(product_id);");
