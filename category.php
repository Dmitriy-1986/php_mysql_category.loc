<?php
// Функция обработки ошибок
error_reporting(E_ALL);

// Подключение к базе данных
$host = 'localhost';
$login = 'root';
$password = '';
$dbname = 'category_loc';

$conn = mysqli_connect($host, $login, $password, $dbname);

function get_post_from_category($conn) {
            // выбирать posts от ... где category='" . $_GET['id'];
    $sql = "SELECT * FROM posts WHERE category=" . $_GET['id'];
    $result = mysqli_query($conn, $sql);
    $arr = array();
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    return $arr;
}

function get_category_info($conn) {
    $sql = "SELECT * FROM categories WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);
    }
    return $row;
}


$data = get_post_from_category($conn);
$cat = get_category_info($conn);

echo "<h1>" . $cat['title'] . "</h1>";

$out = '';
for($i = 0; $i < count($data); $i++) {
    $out .= "<h2>" . $data[$i]['title'] . "</h2>";
    $out .= "<a href='http://localhost/category.loc/post.php?id=" . $data[$i]['id'] . "'><button>Read more</button></a><br>";
    $out .= "<hr>";
}
echo $out;




mysqli_close($conn);
