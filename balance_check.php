<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}

if(isset($_POST['submit'])){

    $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
 
    $select = " SELECT * FROM student WHERE reg_no = '$reg_no' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $balance = $row['balance'];
        $_SESSION['message'] = '<span class="success-msg">The balance for registration number '.$reg_no.' is '.$balance.'</span>';
    } else {
        $_SESSION['message'] = '<span class="error-msg">User does not exist!</span>';
    }
}
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
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
    <div class="form-container">
        <form action="" method="post">
            <?php
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            <input type="text" name="reg_no" required placeholder="Registration Number">
            <input type="submit" name="submit" value="Check Balance" class="form-btn">
        </form>
    </div>
</body>
</html>
