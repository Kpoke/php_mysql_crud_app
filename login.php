<?php
session_start();
include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';
$conn = OpenCon();
if (!empty($_POST['username']) and !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_query = "SELECT * FROM `user` WHERE username = '$username'";
    $result = $conn->query($sql_query);



    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            CloseCon($conn);
            $_SESSION["username"] = $username;
            $_SESSION["first_name"] = $user["first_name"];
            $_SESSION["last_name"] = $user["last_name"];
            header("Location: homepage.php");
            exit;
        } else {
            echo "Invalid Credentials <br /> <br />
            <a href='login.html'>Login</a>";
        }
    } else {
        echo "User does not exist <br /> <br />
        <a href='login.html'>Login</a>";
        exit;
    }
} else {
    echo "Fill in all Entries <br /> <br />
    <a href='login.html'>Login</a>";
}
