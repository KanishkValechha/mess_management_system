<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/1.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="dtd_mess.php">DTD Mess</a></li>
            <li><a href="add_student.php">Add Student</a></li>
            <li><a href="update.php">Update Student Details</a></li>
            <li><a href="balance_check.php">Balance Check</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

</body>
</html>
