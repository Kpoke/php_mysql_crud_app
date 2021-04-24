<?php
session_start();
include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';
$conn = OpenCon();
$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$username = addslashes($_SESSION["username"]);
if (!empty($title) and !empty($description)) {

    $sql_query = "INSERT INTO `course` (`id`, `title`, `description`, `user_username`) VALUES (NULL, '$title', '$description', '$username')";

    if ($conn->query($sql_query) === TRUE) {
        CloseCon($conn);
        echo "course successfully added <br /> <br /> <a href='homepage.php'>Homepage</a>";
        exit;
    } else {
        echo "Error: " . $sql_query . "<br>" . $conn->error . "<br /> <br /> <a href='homepage.php'>Homepage</a>";
        CloseCon($conn);
        exit;
    }
} else {
    echo "Fill in all Entries <br /> <br /> <a href='add_course.html'>Add a new course</a>";
}
