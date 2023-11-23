<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}

if(isset($_POST['submit'])){

    $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
    $balance = mysqli_real_escape_string($conn, $_POST['balance']);
 
    $select = " SELECT * FROM student WHERE reg_no = '$reg_no' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $new_balance = $row['balance'] + $balance;
        $update = "UPDATE student SET balance='$new_balance' WHERE reg_no='$reg_no'";
        if(mysqli_query($conn, $update)){
            $_SESSION['message'] = '<span class="success-msg">Balance updated successfully!</span>';
        } else {
            $_SESSION['message'] = '<span class="error-msg">Error updating balance!</span>';
        }
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
            <input type="text" name="balance" required placeholder="Balance to Add">
            <input type="submit" name="submit" value="Update Balance" class="form-btn">
        </form>
    </div>
</body>
</html>
