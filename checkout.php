<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   
   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = "SELECT * FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res = mysqli_query($conn,$cart_query);
   if(mysqli_num_rows($res) > 0){
      while($cart_item = mysqli_fetch_assoc($res)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'" or die('query failed');
   $res = mysqli_query($conn,$order_query);


   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($res) > 0){
         $message[] = 'order already placed!'; 
      }else if($method == 'cash on delivery'){
       $sql = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')" or die('query failed');
   $res = mysqli_query($conn,$sql);
 
       $message[] = 'order placed successfully!';
   
        $sql1 =  "DELETE FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res = mysqli_query($conn,$sql1);

      }

      if($method == 'credit card')
      {
         
         header('location: card.php');
      }
   }
   



require_once "PHPMailer/PHPMailerAutoload.php";

//==Email Process===================
    $mail = new PHPMailer;
    //Enable SMTP debugging. 
    //$mail->SMTPDebug = 3;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                          
    //Provide username and password     
    $mail->Username = "aliyanmuhammad840@gmail.com";                 
    $mail->Password = "jbtpkwyqgvqastua";                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";                           
    //Set TCP port to connect to 
    $mail->Port = 587;                                   
    
    $mail->From = "aliyanmuhammad840@gmail.com";
    $mail->FromName = "Bookly";
    
    $mail->addAddress($email, "Order");
    //$mail->AddCC($varEmail,'');
    
    $mail->isHTML(true);
    
    $mail->Subject = "Your Order has been placed - Bookly";
    $mail->Body = "<p>Hi <h1>$name</h1> Your Order Has Been Placed.</p> <br><br> <h1>Order Details</h1> 
    <section class='placed-orders'>
    
       <h1 class='title'>placed orders</h1>
    
       <div class='box-container' style = ' max-width: 1200px;
       margin:0 auto;
       display:flex;
       flex-wrap: wrap;
       align-items: center;
       gap:1.5rem;'>
    
  
          
          <div tyle = ' flex:1 1 40rem;
          border-radius: .5rem;
          padding:2rem;
          border:var(--border);
          background-color: var(--light-bg);
          padding:1rem 2rem;'>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> placed on : <span style = '  color:var(--purple);'> $placed_on </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> name : <span style = '  color:var(--purple);'> $name </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> number : <span style = '  color:var(--purple);'> $number </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> email : <span style = '  color:var(--purple);'>$email </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> address : <span style = '  color:var(--purple);'>$address </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> payment method : <span style = '  color:var(--purple);'>$method </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> your orders : <span style = '  color:var(--purple);'> $total_products </span> </p>
             <p style = '   padding:1rem 0;
             font-size: 2rem;
             color:var(--light-color);'> total price : <span style = '  color:var(--purple);'>$$cart_total/-</span> </p>
             </div>
      
       </div>
    
    </section>";
    
    $mail->AltBody = "This is the plain text version of the email content";
    $mail->send();		

 //==End Email Process===================
}
?>

<!-- <h1 style="text-align: center;">Password Reset Link Has Been Successfully send on your Email.</h1> -->



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = "SELECT * FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res = mysqli_query($conn,$select_cart);

      if(mysqli_num_rows($res) > 0){
         while($fetch_cart = mysqli_fetch_assoc($res)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>


<?php




?>