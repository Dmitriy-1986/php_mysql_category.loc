<?php
// Функция обработки ошибок
error_reporting(E_ALL);

// Подключение к базе данных
$host = 'localhost';
$login = 'root';
$password = '';
$dbname = 'category_loc';

$conn = mysqli_connect($host, $login, $password, $dbname);

function get_post($conn) {
    // выбирать posts от ... где category='" . $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=".$_GET['id'];
$result = mysqli_query($conn, $sql);
$arr = array();
if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
}
return $arr;
}

$posts = get_post($conn);

foreach($posts as $post) {
    echo "<h3>" . $post['title'] . "</h3>";
    echo "<p>" . $post['description'] . "</p>";
    echo "<span>Category: " . $post['category_name'] . "</span><br><hr>";
}

