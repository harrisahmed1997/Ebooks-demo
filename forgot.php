<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Please Enter Valid Email ID";
      }
   $select_users = "SELECT * FROM `users` WHERE email = '$email'" or die('query failed');
   $res = mysqli_query($conn,$select_users);
   if(mysqli_num_rows($res) > 0){

      $row = mysqli_fetch_assoc($res);
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:forgot_email_work.php');
   }else{
      $message[] = 'incorrect email';
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
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <span style="color: red ; font-size: 20px ;"><?php if (isset($email_error)) echo $email_error; ?></span>
      <input type="submit" name="submit" value="Submit" class="btn">
   </form>

</div>

</body>
</html>