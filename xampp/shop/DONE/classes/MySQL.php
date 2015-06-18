<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 25.05.2015
 * Time: 12:58
 */

class MySQL
{
    private $mysqlLink;
    private $ip;
    private $name;
    private $pass;
    private $database;

    public function __construct($ip, $name, $pass, $database) {
        $this->ip = $ip;
        $this->name = $name;
        $this->pass = "qwe";
        $this->database = $database;
        $this->EstablishMysqlConnection($ip, $name, $pass, $database);
        $this->SetMysqlCharsetToUtf();
    }

    public function EstablishMysqlConnection($ip, $name, $pass, $database)
    {
        $link = mysql_connect($ip, $name, "qwe")
        or die('Не удалось соединиться: ' . mysql_error());
        // echo 'Соединение успешно установлено<br>';
        mysql_select_db($database) or die('Не удалось выбрать базу данных');
        $this->isMysqlConnectionEstablished = true;
        $this->mysqlLink = $link;
    }

    public function SetMysqlCharsetToUtf()
    {
        mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $this->mysqlLink);
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET CHARACTER SET utf8 ");
        mysql_set_charset('utf8', $this->mysqlLink);

        // $charset = mysql_client_encoding($link);
        // printf ("Current character set is %s\n",$charset);
    }
}