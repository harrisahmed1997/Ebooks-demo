<?php

include 'config.php';

session_start();

$publisherid = $_SESSION['publisher_id'];

if(!isset($publisherid)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'" or die('query failed');
   $res = mysqli_query($conn,$select_message);

   if(mysqli_num_rows($res) > 0){
      $message[] = 'message sent already!';
   }else{
      $sql = "INSERT INTO `message`(user_id, name, email, number, message, user_type) VALUES('$publisherid', '$name', '$email', '$number', '$msg','publisher')" or die('query failed');
      $res = mysqli_query($conn,$sql);
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">


</head>
<body>
   
<?php include 'publisher_header.php'; ?>


<section class="contact">

   <form action="" method="post">
      <h3>Any Question Contact Admin!</h3>
      <input type="text" readonly="true" name="name" required placeholder="enter your name" class="box" value="<?php echo $_SESSION['publisher_name']; ?>">
      <input type="email"  readonly="true" name="email" required placeholder="enter your email" value="<?php echo $_SESSION['publisher_email']; ?>" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>









<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>