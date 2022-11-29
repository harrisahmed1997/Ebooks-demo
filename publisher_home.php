<?php

include 'config.php';

session_start();

$publisherid = $_SESSION['publisher_id'];

if(!isset($publisherid)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'publisher_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
      $select_product = "SELECT * FROM products WHERE p_id = $publisherid" or die('query failed');
      $res = mysqli_query($conn,$select_product);
      $number_of_products = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Number Of Products</p>
      </div>

      <div class="box">
      <?php
      $select_contest = "SELECT * FROM `contest`" or die('query failed');
      $res = mysqli_query($conn,$select_contest);
      $number_of_contest = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_contest; ?></h3>
         <p>Total No of Contestant Stories</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = "SELECT * FROM `orders`" or die('query failed');
            $res = mysqli_query($conn,$select_orders);
            $number_of_orders = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order placed</p>
      </div>

      <div class="box">
         <?php 
            $select_products = "SELECT * FROM `products`" or die('query failed');
            $res = mysqli_query($conn,$select_products);
            $number_of_products = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>products added</p>
      </div>

      <div class="box">
         <?php 
            $select_users ="SELECT * FROM `users` WHERE user_type = 'user'" or die('query failed');
            $res = mysqli_query($conn,$select_users);
            $number_of_users = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php 
            $select_admins = "SELECT * FROM `users` WHERE user_type = 'admin'" or die('query failed');
            $res = mysqli_query($conn,$select_admins);
            $number_of_admins = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php 
            $select_account = "SELECT * FROM `users`" or die('query failed');
            $res = mysqli_query($conn,$select_account);
            $number_of_account = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         <?php 
            $select_messages = "SELECT * FROM `message`" or die('query failed');
            $res = mysqli_query($conn,$select_messages);
            $number_of_messages = mysqli_num_rows($res);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>new messages</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>