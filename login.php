<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass =  password_hash($_POST['password'], PASSWORD_BCRYPT);

   $select = "SELECT * FROM user_form WHERE username = '$username'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    if(password_verify($_POST['password'], $row['password'])){
        
        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $insert = "INSERT INTO login_info(username) VALUES('$username')";
            mysqli_query($conn, $insert);
            header('location:admin_page.php');
        }
    } else {
        
        $error[] = 'incorrect username or password!';
    }
    }else {
    
        $error[] = 'incorrect username or password!';
    }


};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mess Management system</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
    
        <form action="" method="post">
            <h3>login</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <input type="text" name="username" required placeholder="Username">
            <input type="password" name="password" required placeholder="Password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        <form>
    <div>
</body>
</html>