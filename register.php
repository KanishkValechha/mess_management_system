<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = password_hash($_POST['password'],PASSWORD_BCRYPT);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE username = '$username' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{
         $insert = "INSERT INTO user_form(name, email, username, password, user_type) VALUES('$name','$email','$username','$pass','$user_type',)";
         mysqli_query($conn, $insert);
         header('location:login.php');
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Name">
      <input type="email" name="email" required placeholder="Email">
      <input type="text" name="username" required placeholder="Username">
      <input type="password" name="password" required placeholder="Password">
      <select name="user_type">
         <option value="user">student</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>