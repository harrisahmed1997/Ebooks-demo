<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>



<?php 

include 'config.php';

$id = $_GET['id']; // Get id from url bar

if (!$id) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>File Upload PHP Script - Pure Coding</title>
</head>
<body>
	<div class="file__upload">
		<div class="header">
			<p><i class="fa fa-download fa-2x"></i><span><span>down</span>load</span></p>			
		</div>
		<form class="body">
			<div class="download">
                <?php 
                    $sql2 = "SELECT * FROM orders";
                    $res2 = mysqli_query($conn,$sql2);
                    $row = mysqli_fetch_assoc($res2)
                $sql = "SELECT * FROM products WHERE id = $row["id"] ";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    if ($row = mysqli_fetch_assoc($result)) {
                ?>
                		<input type="checkbox" id="link_checkbox">
			<input type="text" value="<?php echo $link; ?>" id="link" readonly>
			<label for="link_checkbox" style="<?php echo $link_status; ?>">Get Sharable Link</label>
                <a href="uploads/<?php echo $row['new_name']; ?>" download="<?php echo $row['name']; ?>" class="download_link"><?php echo $row['name']; ?></a>
                <?php
                    }
                }
                
                ?>
            </div>
		</form>
	</div>
</body>
</html>




<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>