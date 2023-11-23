<?php

@include 'config.php';

session_start();


if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}


if(isset($_POST['select_meal'])){
    $_SESSION['meal'] = mysqli_real_escape_string($conn, $_POST['meal']);
}

if(isset($_POST['submit'])){

    $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
 
    $select = " SELECT * FROM student WHERE reg_no = '$reg_no' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $balance = $row['balance'];
        if($balance >= 50){
            $balance -= 50;
            $update = "UPDATE student SET balance='$balance' WHERE reg_no='$reg_no'";
            $amount= -50;
            $insert = "INSERT INTO transactions(reg_no, amount) VALUES('$reg_no', '$amount')";
            mysqli_query($conn, $update);
            mysqli_query($conn, $insert);
            $_SESSION['message'] = '<span class="success-msg">Meal booked successfully!</span>';
        } else {
            $_SESSION['message'] = '<span class="error-msg">Insufficient balance!</span>';
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
        <?php
        if(!isset($_SESSION['meal'])){
            echo '<form action="" method="post">
                <select name="meal" required>
                    <option value="">Select a meal</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                </select>
                <input type="submit" name="select_meal" value="Select Meal" class="form-btn">
            </form>';
        } else {
            echo '<form action="" method="post">';
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']); 
            };
            echo '<input type="text" name="reg_no" required placeholder="Registration Number">
            <input type="submit" name="submit" value="Book Meal" class="form-btn">
        </form>';
        }
        ?>
    </div>
</body>
</html>
