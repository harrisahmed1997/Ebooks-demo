<?php


    
include 'config.php';
session_start();
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
    
    $mail->addAddress($b, "Forgot");
    //$mail->AddCC($varEmail,'');
    
    $mail->isHTML(true);
    
    $mail->Subject = "Forgot Password - Bookly";
    $mail->Body = "<h1>$a</h1><p>It takes a Few minutes to reset your password for <h1>$b</h1> Just click reset password link and update your password.</p> <a href='http://localhost/project/update_password.php'>Reset Your Password</a>";
    
    $mail->AltBody = "This is the plain text version of the email content";
    $mail->send();		

 //==End Email Process===================
?>
<h1 style="text-align: center;">Password Reset Link Has Been Successfully send on your Email.</h1>


