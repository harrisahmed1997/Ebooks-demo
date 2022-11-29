<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = 'credit card';
   $address = mysqli_real_escape_string($conn, 'address. '. $_POST['address'].', '. $_POST['city'].', '. $_POST['state'].', '. $_POST['country'].' - '. $_POST['zip']);
   $placed_on = date('d-M-Y');
    $card_name = $_POST['cardname'];
    $card_number = $_POST['cardnumber'];
    $exp_month = $_POST['expmonth'];
    $exp_year = $_POST['expyear'];
    $cvv = $_POST['cvv'];
   
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

   $order_query = "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND method = '$method' AND email = '$email'  AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'" or die('query failed');
   $res = mysqli_query($conn,$order_query);


   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($res) > 0){
         $message[] = 'order already placed!'; 
      }else if($method == 'credit card'){
       $sql = "INSERT INTO `orders`(`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `card_name`, `card_number`, `exp_month`, `exp_year`, `cvv`) VALUES('$user_id', '$name', '$number', '$email', 'credit card', '$address','$total_products', '$cart_total','$placed_on','$card_name','$card_number','$exp_month','$exp_year',$cvv)" or die('query failed');
   $res = mysqli_query($conn,$sql);
 
       $message[] = 'order placed successfully!';
   
        $sql1 =  "DELETE FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res = mysqli_query($conn,$sql1);

      }

      if($method == 'cash on delivery')
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

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Card Payement</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


   <style>
form {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.containerss {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text],[type=number] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.lb {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btns {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">Home</a> / checkout-card </p>
</div>

 
<div style="margin:50px;">
   <form action="" method="post">
  <div class="col-75">
    <div class="containerss">
      <form  action="/action_page.php">

        <div class="row" style="display: -ms-flexbox;  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0 -16px;">
          <div class="col-50" style="-ms-flex: 50%; /* IE10 */
  flex: 50%;">
            <label  class = "lb" for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input name="name" type="text" id="fname"  placeholder="John M. Doe">
            <label  class = "lb" for="fname"><i class="fa fa-user"></i>Phone No</label>
            <input name="number" type="number" id="fname"  placeholder="+923323940589">
            <label class = "lb" for="email"><i class="fa fa-envelope"></i> Email</label>
            <input name="email" class = "lb" type="text" id="email"  placeholder="john@example.com">
            <label class = "lb" for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label  class = "lb"for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">
            <label  class = "lb"for="city"><i class="fa fa-institution"></i> Country</label>
            <input type="text" id="city" name="country" placeholder="Pakistan">
            <div class="row">
              <div class="col-50" style="-ms-flex: 50%; /* IE10 */
  flex: 50%;">
                <label class = "lb" for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50" style="-ms-flex: 50%; /* IE10 */
  flex: 50%;">
                <label  class = "lb" for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50" style="-ms-flex: 50%; /* IE10 */
  flex: 50%;">
            <h3>Payment</h3>
            <label class = "lb" for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa-brands fa-cc-visa" style="color:navy;"></i>
              <i class="fa-brands fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa-brands fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa-brands fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label class = "lb" for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label class = "lb" for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label class = "lb" for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50" style="-ms-flex: 50%; /* IE10 */
  flex: 50%;">
                <label class = "lb" for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50" style="-ms-flex: 50%; /* IE10 */
  flex: 50%;">
                <label class = "lb" for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>
        <label class = "lb">
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Continue to checkout" name="btn" class="btns">
      </form>
    </div>
  </div>

   </form>
</div>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>