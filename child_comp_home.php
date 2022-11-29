<?php

include 'config.php';



if(isset($_POST['add_to_cart'])){

header('location:login.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

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

<header class="header">

<div class="header-1" style="background-color: black;">
      <div class="flex">
         <div class="share">
          <p style="color : white;">Winner Of Stories Contest will be announce on the last date of the month.</p>
         </div>
         <p><a style="color:white;" href="contest.php">Participate</a></p>
      </div>
   </div>

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Bookly.</a>

      </div>
   </div>

</header>

<section class="home">

   <div class="content">
      <h3>Welcome The Next Generation</h3>
      <p>You can show us your skills and submit an essay on given topics in given time and Get a Chance to win Amazing Prizes.</p>
      <a href="essay_comp.php" class="white-btn">Start Competition</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Topics For Essay</h1>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Rules For Writing Essay!</h3>
      <p>1) Your Essay must be submit in the form of word,pdf or text file.</p>
      <p>2) Your Essay must not be copied from internet or any other source.</p>
      <p>3) Your Essay is in the minimum limits of line given by us.</p>


      <a href="essay_comp.php" class="white-btn">Start Competition</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>About us</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
         <a href="login.php" class="btn">read more</a>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>