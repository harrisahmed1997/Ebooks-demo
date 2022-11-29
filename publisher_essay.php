<?php

include 'config.php';

session_start();

$publisherid = $_SESSION['publisher_id'];

if(!isset($publisherid)){
   header('location:login.php');
}



if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM `essays` WHERE id = '$delete_id'" or die('query failed');
    $res = mysqli_query($conn,$sql);
    header('location:publisher_essay.php');
 }


 if(isset($_POST['sub'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $lines = mysqli_real_escape_string($conn, $_POST['lines']);
   $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
   $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

   $select_message = "SELECT * FROM `essays` WHERE name = '$name'" or die('query failed');
   $res = mysqli_query($conn,$select_message);

   if(mysqli_num_rows($res) > 0){
      $message[] = '
      Compitition added already!';
   }
   if(mysqli_num_rows($res) > 0){
      $message[] = '
      Competition added already!';
   }
   else{
      $sql = "INSERT INTO `essays`(name,essay_lines,start_date,end_date) VALUES('$name',$lines,'$start_date','$end_date')" or die('query failed');
      $res = mysqli_query($conn,$sql);
      $message[] = 'Compitition Added successfully!';
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Essay Competition</title>

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
      <h3>Competition Information!</h3>
      <input type="text"  name="name" required placeholder="enter Essay  topic  name" class="box">
      <input type="number"  name="lines" required placeholder="enter essay topic lines" class="box">
      <input type="text" name="start_date" readonly = "true" value = "<?php echo date('d/m/y H:i:s'); ?>" required placeholder="enter start date and time"class="box">
      <input type="text" name="end_date" required   value = "<?php echo date('d/m/y H:i:s', time()+10800); ?>" readonly = "true"class="box">
      

      <input type="submit" value="Submit" name="sub" class="btn">
   </form>

</section>


<section class="messages">

   <h1 class="title"> Essay Topics </h1>

   <div class="box-container">
   <?php
      $sql = "SELECT * FROM `essays`" or die('query failed');
   $res = mysqli_query($conn,$sql);
      if(mysqli_num_rows($res) > 0){
         while($fetch_message = mysqli_fetch_assoc($res)){
      
   ?>
   <div class="box">
      <p> id : <span><?php echo $fetch_message['id']; ?></span> </p>
      <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> no of lines : <span><?php echo $fetch_message['essay_lines']; ?></span> </p>
      <p> start date : <span><?php echo $fetch_message['start_date']; ?></span> </p>
      <p> end date : <span><?php echo $fetch_message['end_date']; ?></span> </p>

      <a href="publisher_essay.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">No topics were added by you!</p>';
   }
   ?>
   </div>

</section>


<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>