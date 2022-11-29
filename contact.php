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
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'" or die('query failed');
   $res = mysqli_query($conn,$select_message);

   if(mysqli_num_rows($res) > 0){
      $message[] = 'message sent already!';
   }else{
      $sql = "INSERT INTO `message`(user_id, name, email, number, message, user_type) VALUES('$user_id', '$name', '$email', '$number', '$msg','user')" or die('query failed');
      $res = mysqli_query($conn,$sql);
      $message[] = 'message sent successfully!';
   }



require_once "PHPMailer/PHPMailerAutoload.php";
$a = $_SESSION['user_name'];
$b = $_SESSION['user_email'];


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
    
    $mail->addAddress($b, "Bookly");
    //$mail->AddCC($varEmail,'');
    
    $mail->isHTML(true);
    
    $mail->Subject = "Thanks For Submitting Form - Bookly";
    $mail->Body = "<h1>$name</h1><p>Thanks For Submitting The Form. Your Form has been submitted to our server.</p> <h1>Your Form Message</h1><br><br><h3>$msg</h3>";
    
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
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" readonly = "true" value="<?php echo $_SESSION['user_name']; ?>" class="box">
      <input type="email" name="email" required placeholder="enter your email" readonly = "true" value="<?php echo $_SESSION['user_email']; ?>" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>


<h1 style="text-align: center; font-size: 30px; text-decoration:underline;">Purchase Book from Book Dealer</h1>
<div style="  margin: 50px;  margin-right:20px; margin-left:20px;">
   <iframe style="outline: 0.5px solid black;" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319" width="100%" height="200" frameborder="0" style="border:0"></iframe>
</div>






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>