<?php
// Функция обработки ошибок
error_reporting(E_ALL);

// Подключение к базе данных
$host = 'localhost';
$login = 'root';
$password = '';
$dbname = 'category_loc';

$conn = mysqli_connect($host, $login, $password, $dbname);

?>

<!--  Посты -->
<h2>Posts</h2>

<?php
function get_posts_category() {
    global $conn;
    $sql = "SELECT * FROM `posts`";
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;
}

$posts = get_posts_category($conn);

for($i = 0; $i < count($posts); $i++) {
    echo "<h3>" . $posts[$i]['title'] . "</h3>";
    echo "<a href='http://localhost/category.loc/post.php?id=" . $posts[$i]['id'] . "'><button>Read more</button></a><br>";
    echo "<span>Category: ".$posts[$i]['category_name']."</span><br><hr>";
}
?>

<!-- Категории -->
<h2>All Categories</h2>

<?php
$category = "SELECT * FROM `categories`";

$result = mysqli_query($conn, $category);

echo "<ul>";

foreach($result as $cat) {
    echo "<li><a href='http://localhost/category.loc/category.php?id=" . $cat['id'] . "'>" . $cat['title'] . "</a></li>";
}

echo "</ul><br><br>";