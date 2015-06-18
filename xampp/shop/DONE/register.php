<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 13:02
 */

function registration()
{
    if (isset($_POST['submit'])) {
        $err = array();
        $login = mysql_real_escape_string($_POST['login']);

        if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
        }

        if (strlen($login) < 3 or strlen($login) > 30) {
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        }

        $query = mysql_query("SELECT COUNT(id) FROM users WHERE login='" . $login . "'");

        if (mysql_result($query, 0) > 0) {
            $err[] = "Пользователь с таким логином уже существует в базе данных";
        }

        if (count($err) == 0) {
            $password = md5(md5(trim($_POST['password'])));
            mysql_query("INSERT INTO users SET login='" . $login . "', password='" . $password . "'");
            exit();
        } else {
            print "<b>При регистрации произошли следующие ошибки:</b><br>";

            foreach ($err AS $error) {
                print $error . "<br>";
            }
        }
    }

    print '<form method="POST">
        Логин <input name="login" type="text"><br>
        Пароль <input name="password" type="password"><br>
        <input name="submit" type="submit" value="Зарегистрироваться">
        </form>';

}


