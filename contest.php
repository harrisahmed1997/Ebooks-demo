<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $story_name = $_POST['story_name'];
    $story_type = $_POST['method'];
    $file = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = 'uploaded_file/'.$file;
 
    $select_product_name = "SELECT story_name FROM `contest` WHERE story_name = '$story_name'" or die('query failed');
    $res = mysqli_query($conn,$select_product_name);
    if(mysqli_num_rows($res) > 0){
       $message[] = 'story already added';
    }else{
  
       $add_product_query = "INSERT INTO `contest`(user_name,user_email,user_number,image,story_name,type) VALUES('$name','$email','$number', '$file','$story_name','story')" or die('query failed');
       $res = mysqli_query($conn,$add_product_query);
 
       if($add_product_query){
          if($file_size > 2000000){
             $message[] = 'file size is too large';
          }else{
             move_uploaded_file($file_tmp_name, $file_folder);
             $message[] = 'Story submitted successfully!';
          }
       }else{
          $message[] = 'Story not Added';
       }
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contest</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / Contest </p>
</div>

<section class="contact">

   <form action="" method="post" enctype="multipart/form-data">
   <h3 style="font-size: 30px ;">Submit Your Stories</h3>
      <h4 style="font-size: 15px ;"><b>Get a chance to publish it in our books and Win amazing prizes</b></h4>
      <input type="text" name="name" required placeholder="enter your name" readonly = "true" value="<?php echo $_SESSION['user_name']; ?>" class="box">
      <input type="email" name="email" required placeholder="enter your email" readonly = "true" value="<?php echo $_SESSION['user_email']; ?>" class="box">
      <input type="text" name="number" required placeholder="enter your phone number" class="box">
      <input type="story_name" name="story_name" required placeholder="enter story name" class="box">
      <div class="inputBox">
            <select name="method" class="box">
            <option selected>Story Type / Category</option>
               <option value="General Knowledge">General Knowledge</option>
               <option value="Horror">Horror</option>
               <option value="Funny">Funny</option>
               <option value="Interesting">Interesting</option>
               <option value="Other">Other</option>
            </select>
         </div>
      <input type="file" name="file" accept=".pdf,.doc,.txt" class="box" required>

      <input style = "width:100%;" type="submit" value="send message" name="send" class="btn">
   
   </form>



<br><br><br>
<h3 style="text-align: center; font-size: 25px;">Are You a Child? | Submit Your Essay <a href="child_comp_home.php">Participate now</a></h3>

</section>
<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/admin_script.js"></script>
</body>
</html>