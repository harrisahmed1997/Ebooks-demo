<?php

include 'config.php';
session_start();
if(isset($_POST['submit'])){

   $email = $_SESSION['user_email'];
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

   $select_users = "SELECT * FROM `users` WHERE email = '$email'" or die('query failed');
   $res = mysqli_query($conn,$select_users);

  
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $reg = "UPDATE `users` SET `password`='$pass' WHERE email = '$email'" or die('query failed');
        $res1 = mysqli_query($conn,$reg);
         $message[] = 'updated successfully!';
         header('location:login.php');
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
      <h3>Forgot Password</h3>
      <input type="password" name="password" placeholder="Enter New Password" required class="box">
      <input type="password" name="confirm_password" placeholder="Confirm Your Password" required class="box">
      <!-- //<span style="color: red ; font-size: 20px ;"><?php if (isset($email_error)) echo $email_error; ?></span> -->
      <input type="submit" name="submit" value="Submit" class="btn">
   </form>

</div>

</body>
</html>