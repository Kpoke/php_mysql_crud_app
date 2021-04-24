<?php
session_start();
include 'C:\xampp\htdocs\php_basic_crud_app\db_connnection.php';
$conn = OpenCon();

if (!empty($_POST['title']) and !empty($_POST['description']) and !empty($_POST['id'])) {
    $title = addslashes($_POST['title']);
    $description = addslashes($_POST['description']);
    $id = addslashes($_POST['id']);
    
    $sql_query = "UPDATE `course` SET `title` = '$title', `description` = '$description' WHERE `course`.`id` = '$id'";

    if ($conn->query($sql_query) === TRUE) {
        CloseCon($conn);
        echo "course successfully updated <br /> <br /> <a href='homepage.php'>Homepage</a>";
        exit;
    } else {
        echo "Error: " . $sql_query . "<br>" . $conn->error . "<br /> <br /> <a href='homepage.php'>Homepage</a>";
        CloseCon($conn);
        exit;
    }
} else if (!empty($_GET['id'])) {
    $course_id = $_GET['id'];

    $sql_query = "SELECT * FROM `course` WHERE id = '$course_id'";
    $result = $conn->query($sql_query);

    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        $title = $course["title"];
        $description = $course["description"];
    } else {
        echo "Course does not exist <br /> <br />
        <a href='homepage.php'>Home</a>";
    }
} else {
    echo "Oops, An Error Occurred <br /> <br />
<a href='homepage.php'>Home</a>";
}


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

    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

        Title
        <br />
        <input type="text" name="title" value="<?php echo $title; ?>">

        <br />
        <br />

        Description
        <br />
        <input type="text" name="description" value="<?php echo $description; ?>">

        <br />
        <br />

        <input type="hidden" name="id" value="<?php echo $course_id; ?>" />

        <input type="submit" name="formSubmit" value="Submit">
    </form>
    <br />
    <br />
    <a href='homepage.php'>Homepage</a>;

</body>

</html>