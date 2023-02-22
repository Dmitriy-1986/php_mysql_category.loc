<?php
// Функция обработки ошибок
error_reporting(E_ALL);

// truncate table info;

// Подключение к базе данных
$host = 'localhost';
$login = 'root';
$password = '';
$dbname = 'category_loc';

$conn = mysqli_connect($host, $login, $password, $dbname);

// Add post
function insert_post($conn) {

    if(isset($_POST['add_post'])) {
        $get_title = $_POST['title'];
        $get_description = $_POST['description'];
        $get_category_number = $_POST['category_number'];
        $get_category_name = $_POST['category_name'];

        $sql_insert = "INSERT INTO `posts` (`id`, `title`, `description`, `category`, `category_name`) 
        VALUES (NULL, '$get_title', '$get_description', '$get_category_number', '$get_category_name')";

        if (mysqli_query($conn, $sql_insert)) {
            header('Location: admin.php');
            exit; 
        } else {
            echo "Error: <br>" . mysqli_error($conn);
        };

    }
}
insert_post($conn);

// Add category
function insert_category($conn) {

    if(isset($_POST['add_category'])) {
        $get_category_title = $_POST['category_title'];
        
        $sql_insert = "INSERT INTO `categories` (`id`, `title`) VALUES (NULL, '$get_category_title')";

        if (mysqli_query($conn, $sql_insert)) {
            header('Location: admin.php');
            exit; 
        } else {
            echo "Error: <br>" . mysqli_error($conn);
        };

    }
}
insert_category($conn);

?>
<h1 style='text-align: center;'>Admin Panel</h1>
<h2>Add Post</h2>
<form action="admin.php" method="POST">
    <input type="text" name="title" placeholder="Title Post"><br><br>
    <textarea type="text" name="description" placeholder="Description"></textarea><br><br>
    <input type="number" name="category_number" placeholder="Category Number"><br><br>
    <input type="text" name="category_name" placeholder="Category Name"><br><br>
    <input type="submit" name="add_post" value="Submit">
</form>

<hr>
<h2>Add New Category</h2>
<form action="admin.php" method="POST">
    <input type="text" name="category_title" placeholder="Title Category"><br><br>
    <input type="submit" name="add_category" value="Submit">
</form>

<h2>All Categories</h2>
<?php
$category = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $category);

echo "<ul>";
foreach($result as $cat) {
    echo "<li>#" . $cat['id'] . " - <a href='http://localhost/category.loc/category.php?id=" . $cat['id'] . "'>" . $cat['title'] . "</a></li>";
}
echo "</ul><br><br>";
