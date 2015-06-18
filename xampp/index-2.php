<?php
ini_set('max_execution_time', 0);
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 23.05.2015
 * Time: 15:33
 */

class Parser
{
    public $car;
    public $root;
    public $linkArrays;
    public $cleanLinks;
    public $isMysqlConnectionEstablished;
    public $markDatabaseId;
    private $mysqlLink;

    public function __construct($car)
    {
        $this->linkArrays = array(array(""));
        $this->cleanLinks = array("");
        $this->car = $car;
        $this->root = "http://auto.ru/cars/" . $car . "/used/?show_sales=1&p=";
        $this->isMysqlConnectionEstablished = true;
    }

    private function LoadHTML($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    private function ParseLinksOnPage($document)
    {
        $links = array(array(""));
        $result = preg_match_all('(http:\/\/auto.ru\/cars\/used\/sale\/[0-9]{1,15}-[a-zA-Z0-9]{1,10})', $document, $links);
        return $links;
    }

    public function StartParseLinks()
    {
        $newCars = true;
        $page = 1;
        while ($newCars) {
            $uri = $this->root . $page;
            $document = $this->LoadHTML($uri);
            // $document = file_get_contents($uri);
            $links = $this->ParseLinksOnPage($document);

            if (count($links[0]) == 0)
                $newCars = false;

            if (!array_diff($this->linkArrays[$page - 1], $links[0]))
                $newCars = false;

            if ($newCars)
                array_push($this->linkArrays, $links[0]);

            /*print count($links[0])."<br>";
            print $page."<br>";

            print $uri."<br>";
            foreach ($links[0] as $item) {
                print $item."<br>";
            }
            print $document."<br>";
            print "<br>";*/

            ++$page;
            //print "YOLO";
            //print "We are going to sleep after ".$page." page now.<br>";
        }

        unset($this->linkArrays[0]);

        foreach ($this->linkArrays as $links) {
            foreach ($links as $link) {
                if (!in_array($link, $this->cleanLinks))
                    array_push($this->cleanLinks, $link);
            }
        }

        unset($this->cleanLinks[0]);

        if ($this->isMysqlConnectionEstablished) {
            $count = count($this->cleanLinks);
            $query = 'INSERT INTO cars_marks (mark, amount) VALUES ("' . $this->car . '", ' . $count .') ON DUPLICATE KEY UPDATE amount=' . $count . ';';
            //print $query."<br>";
            $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());

            $query = 'SELECT t1.mark_id FROM cars_marks t1 WHERE t1.mark="'.$this->car.'";';
            $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
            $row = mysql_fetch_assoc($result);
            $this->markDatabaseId = $row['mark_id'];

            $query = "DELETE FROM `cars_details` WHERE mark_id=$this->markDatabaseId;";
            $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());

            $query = "DELETE FROM `cars_images` WHERE car_mark_id=$this->markDatabaseId;";
            $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
        }
    }

    public function GetLinks()
    {
        return $this->cleanLinks;
    }

    public function GetLinksCount()
    {
        return count($this->cleanLinks);
    }

    public $id = array();

    public function StartParseDetails()
    {
        foreach ($this->cleanLinks as $link) {
            //print $link."<br>";
            $document = file_get_contents($link);
            $document = mb_convert_encoding($document, 'HTML-ENTITIES', "UTF-8");
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($document);
            $xpath = new DomXPath($dom);
            libxml_use_internal_errors(false);
            $detail_titles = $dom->getElementsByTagName('dt'); // например, год выпуска
            $details = $dom->getElementsByTagName('dd'); // например, 2004

            $img = $xpath->query("//*[contains(@class, 'b-fotorama-photo-img')]"); // изображения
            $image = $img->item(0)->attributes->getNamedItem("src")->nodeValue; // изображение

            $price = $xpath->query("//*[contains(@itemprop, 'price')]");
            $price = $price->item(0)->nodeValue; // изображение

            $title = $xpath->query("//*[contains(@class, 'card-title')]");
            $title = $title->item(0)->nodeValue; // изображение

            $year = $details->item(0)->nodeValue;
            $mileage = $details->item(1)->nodeValue;

            //$title = str_replace(' ', '', $title);
            //$price = str_replace('?', '', $price);
            //$year = str_replace(' ', '', $year);
            //$mileage = str_replace(' ', '', $mileage);


            if ($this->isMysqlConnectionEstablished) {
                $query = 'INSERT INTO cars_details (mark_id, cost, title, year, mileage, uri, img_uri) VALUES (' . $this->markDatabaseId . ', "' . $price . '", "' . $title . '", "' . $year . '", "' . $mileage . '", "' . $link . '", "' . $image . '");';   // ON DUPLICATE KEY UPDATE (mark_id=' . $this->markDatabaseId . ', price="' . $price . '", title="' . $title . '", year="' . $year . '", mileage="' . $mileage . '");';
                //print $query."<br>";
                array_push($this->id, mysql_insert_id());
                $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
                $lastId = mysql_insert_id();
                $bin_string = file_get_contents($image);
                $hex_string = base64_encode($bin_string);
                mysql_query("INSERT INTO cars_images(image, car_detail_id) VALUES ('$hex_string', $lastId)");
            }

            /*echo $title."<br>";
            echo $price."<br>";
            echo $image."<br>";
            for ($i = 0; $i < $detail_titles->length; ++$i) {
                echo $detail_titles->item($i)->nodeValue."<br>";
                echo $details->item($i)->nodeValue."<br>";
                echo "<br>";
            }*/
        }

    }
}

function SetMysqlCharsetToUtf($link)
{
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $link);
    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER SET utf8 ");
    mysql_set_charset('utf8', $link);
}

function conn() {
    $link = mysql_connect('127.0.0.1', 'root', 'qwe')
    or die('Не удалось соединиться: ' . mysql_error());
    mysql_select_db('cars') or die('Не удалось выбрать базу данных');
    SetMysqlCharsetToUtf($link);
}

conn();

if (isset($_GET['car']) and !isset($_GET['id'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        print '<a href="public.php">Назад к выбору марки</a><br><br>';
    }
    if (strlen(isset($_GET['car'])) == 0) {
        print "Название автомобиля не введено";
        exit;
    }
    if (isset($_GET['new'])) {
        $car = $_GET['car'];
        print "Parsing $car... ";
        $parser = new Parser($car, true);
        $parser->StartParseLinks();
        $parser->StartParseDetails();
        print "Done!";

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: ?car=".$_GET['car']);
        }
    } else {
        conn();
        $carMakr = $_GET['car'];
        $markIdQuery = mysql_query("SELECT mark_id FROM cars_marks WHERE mark='$carMakr' LIMIT 1");
        if (mysql_num_rows($markIdQuery) === 0) {
            print "Не распарсили";
            exit;
        }

        $markId = mysql_fetch_assoc($markIdQuery)['mark_id'];
        $details = mysql_query("SELECT * FROM cars_details WHERE mark_id=$markId");

        if (mysql_num_rows($details) === 0) {
            print "Автомобилей данной марки нет!";
            exit;
        }

        while  ($row = mysql_fetch_assoc($details)) {
            $title = $row['title'];
            print '<a href="?id=';
            print $row['car_id'];
            print '">';
            print $title . '</a><br>';
        }
    }
} elseif (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $details = mysql_query("SELECT * FROM cars_details WHERE car_id=$car_id");

    while ($row = mysql_fetch_assoc($details)) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            print '<a href="'.$_SERVER["HTTP_REFERER"].'">Назад к списку автомобилей</a><br><br>';
        }


        $img = mysql_query("SELECT image FROM cars_images WHERE car_detail_id=$car_id LIMIT 1");
        if (mysql_num_rows($img) !== 0) {
            $img = mysql_fetch_assoc($img);
            $img = $img['image'];
            print '<img width="100px" src="data:image/png;base64,'.$img.'"><br>';
        }

        print $row['title'] . '<br>';
        print $row['cost'] . '<br>';
        print $row['year'] . '<br>';
        print $row['mileage'] . '<br>';
        $uri = $row['uri'];
        print '<a href="'.$uri.'">Перейсти на страницу на auto.ru</a><br>';


    }
} else {
    print '<form method="get">
        Название: <input type="text" name="car" /><br>
        <input type="checkbox" name="new"/>Парсить? <br>
        <button type="submit" class="right">Показать</button>
    </form>';
}











