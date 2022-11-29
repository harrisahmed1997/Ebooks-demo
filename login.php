<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Please Enter Valid Email ID";
      }
   $select_users = "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'" or die('query failed');
   $res = mysqli_query($conn,$select_users);
   if(mysqli_num_rows($res) > 0){

      $row = mysqli_fetch_assoc($res);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }
      if($row['user_type'] == 'publisher/client'){

         $_SESSION['publisher_name'] = $row['name'];
         $_SESSION['publisher_email'] = $row['email'];
         $_SESSION['publisher_id'] = $row['id'];
         header('location:publisher_home.php');

      }
      elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <span style="color: red ; font-size: 20px ;"><?php if (isset($email_error)) echo $email_error; ?></span>
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? | Forgot Your Password <a href="register.php">register now</a>&ensp;  | &ensp; <a href="forgot.php">Forgot Password</a></p>
   </form>

</div>

</body>
</html>