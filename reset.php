<?php
session_start();
include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';
$conn = OpenCon();
$username = $_SESSION["username"];
if (!empty($_POST['new_password']) and !empty($_POST['confirm_new_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password == $confirm_new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql_query = "UPDATE `user` SET `password` = '$hashed_password' WHERE `user`.`username` = '$username'";

        if ($conn->query($sql_query) === TRUE) {
            CloseCon($conn);
            echo "Password changed successfully <br /> <br />
                    <a href='homepage.php'>Home</a>";
            exit;
        } else {
            echo "Error: " . $sql_query . "<br>" . $conn->error . "<br /> <br /> <a href='register.html'>Register</a>";
            CloseCon($conn);
            exit;
        }
    } else {
        echo "Passwords do not match <br /> <br />
        <a href='homepage.php'>Home</a>";
    }
} else {
    echo "Fill in all Entries <br /> <br />
    <a href='homepage.php'>Home</a>";
}
