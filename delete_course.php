<?php
session_start();
include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';

function delete_course($course_id)
{
    $conn = OpenCon();
    $sql_query = "DELETE FROM `course` WHERE `course`.`id` = '$course_id'";

    if ($conn->query($sql_query) === TRUE) {
        CloseCon($conn);
        echo "Deleted successfully <br /> <br />
                <a href='homepage.php'>Homepage</a>";
        exit;
    } else {
        echo "Error: " . $sql_query . "<br>" . $conn->error . "<br /> <br /> <a href='homepage.php'>Homepage</a>";
        CloseCon($conn);
        exit;
    }
}

if (!empty($_GET['id'])) {
    delete_course($_GET['id']);
} else {
    echo "Oops, An Error Occurred <br /> <br />
    <a href='homepage.php'>Home</a>";
}
