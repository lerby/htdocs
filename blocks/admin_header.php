<?php
function printAdminHeader() {
    print '
        <div class="header">
            <h1 align="center">Интернет магазин</h1><br>
            <a href="/public_html">Главная страница</a>
            <a href="/public_html/admin/category">Категории</a>
            <a href="/public_html/admin/product">Продукты</a>
            <a href="/public_html/admin/user">Пользователи</a>
            <a href="/public_html/admin/order">Заказы</a>
        </div>
    ';
}