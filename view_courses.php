<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <?php
    include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';
    $conn = OpenCon();
    $username = $_SESSION['username'];
    $sql_query = "SELECT * FROM `course` WHERE user_username = '$username'";
    $result = $conn->query($sql_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " || Title: " . $row["title"] . "||Description: " . $row["description"] . ' <a href="delete_course.php?id=' . $row["id"] . ' ">Delete Course</a>' . " || " . ' <a href="edit_course.php?id=' . $row["id"] . ' ">Edit Course</a>' . "<br><br>";
        }
        echo "<a href='homepage.php'>Homepage</a>";
    } else {
        echo "You don't have any courses <br /> <br />
        <a href='homepage.php'>Homepage</a>";
        exit;
    }

    ?>

</body>

</html>