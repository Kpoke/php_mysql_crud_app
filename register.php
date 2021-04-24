<?php
session_start();
include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';
$conn = OpenCon();
$username = $_POST['username'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
if (!empty($username) and !empty($first_name) and !empty($last_name) and !empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_query = "INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES (NULL, '$first_name', '$last_name', '$username', '$hashed_password')";

    if ($conn->query($sql_query) === TRUE) {
        CloseCon($conn);
        $_SESSION["username"] = $username;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        header("Location: homepage.php");
        exit;
    } else {
        echo "Error: " . $sql_query . "<br>" . $conn->error . "<br /> <br /> <a href='register.html'>Register</a>";
        CloseCon($conn);
        exit;
    }
} else {
    echo "Fill in all Entries <br /> <br /> <a href='register.html'>Register</a>";
}
