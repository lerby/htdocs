<?php

class loginWorker {
    public $isLogged = false;
    public $isAdmin = false;
    public $userName = false;
    public $hash = false;
    public $id = false;
    public $blocked = false;

    public function generateCode($length = 20) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

    public function isLoggedIn($id, $hash) {
        $query = mysql_query("SELECT * FROM users WHERE id = '".intval($id)."' LIMIT 1");
        $userData = mysql_fetch_assoc($query);

        if(($userData['hash'] === $hash) and ($userData['id'] === $id)) {
            $this->isLogged = true;
            $this->userName = $userData['login'];
            $this->hash = $userData['hash'];
            $this->id = $userData['id'];
        }

        if ($userData['permission'] == 1)
            $this->isAdmin = true;

        if ($userData['blocked'] == 1)
            $this->blocked = true;

        return $this->isLogged;
    }

    public function logIn($login, $password)  {
        $login = mysql_real_escape_string($login);
        $password = mysql_real_escape_string($password);
        $query = mysql_query("SELECT * FROM users WHERE login='".$login."' LIMIT 1");
        $data = mysql_fetch_assoc($query);

        if($data['password'] == md5(md5($password))) {
            $hash = md5($this->generateCode());
            mysql_query("UPDATE users SET hash='".$hash."' WHERE id=".$data['id']);
            $this->isLogged = true;
            $this->userName = $login;
            $this->hash = $hash;
            $this->id = $data['id'];

            if ($data['permission'] == 1) {
                $this->isAdmin = true;
            }

            if ($data['blocked'] == 1)
                $this->blocked = true;

            return true;
        }

        return false;
    }


    public function getLoginForm() {
        return '<form method="POST">
                Логин <input name="login" type="text"><br>
                Пароль <input name="password" type="password"><br>
                <input name="submit" type="submit" value="Войти">
                </form>';
    }

    public function getLoginBlock() {
        if ($this->isLogged) {
            return 'Вы авторизованы как ' . $this->userName;
        } else {
            return $this->getLoginForm();
        }
    }

}




