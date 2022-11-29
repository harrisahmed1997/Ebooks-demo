<?php

include 'config.php';

session_start();

$PUBLISHER_ID = $_SESSION['publisher_id'];

if(!isset($PUBLISHER_ID)){
   header('location:login.php');
};

if(isset($_POST['upload'])){ // If isset upload button or not

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $category = $_POST['method'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;


   $link = "";
   $link_status = "display: none;";
   

      // Declaring Variables
      $location = "uploaded_file/";
      $file_new_name = date("dmy") . time() . $_FILES["file"]["name"]; // New and unique name of uploaded file
      $file_name = $_FILES["file"]["name"]; // Get uploaded file name
      $file_temp = $_FILES["file"]["tmp_name"]; // Get uploaded file temp
      $file_size = $_FILES["file"]["size"]; // Get uploaded file size
   
      /*
      How we can get mb from bytes
      (mb*1024)*1024
   
      In my case i'm 10 mb limit
      (10*1024)*1024
      */
   
      if ($file_size > 10485760) { // Check file size 10mb or not
         echo "<script>alert('Woops! File is too big. Maximum file size allowed for upload 10 MB.')</script>";
      } else {
         $sql = "INSERT INTO products (file_name, file_path)
               VALUES ('$file_name', '$file_new_name')";
         $result = mysqli_query($conn, $sql);
         if ($result) {
            move_uploaded_file($file_temp, $location . $file_new_name);
            echo "<script>alert('Wow! File uploaded successfully.')</script>";
            // Select id from database
            $sql = "SELECT id FROM products ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
               $link = $base_url . "order.php?id=" . $row['id'];
               $link_status = "display: block;";
            }
         } else {
            echo "<script>alert('Woops! Something wong went.')</script>";
         }
      }


   $select_product_name = "SELECT name FROM `products` WHERE name = '$name'" or die('query failed');
   $res = mysqli_query($conn,$select_product_name);
   if(mysqli_num_rows($res) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = "INSERT INTO `products`(name,category, price, image, p_id) VALUES('$name','$category', '$price', '$image',$PUBLISHER_ID)" or die('query failed');
      $res = mysqli_query($conn,$add_product_query);

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query =  "SELECT image FROM `products` WHERE id = '$delete_id'" or die('query failed');
   $res = mysqli_query($conn,$delete_image_query);
   $fetch_delete_image = mysqli_fetch_assoc($res);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $sql = "DELETE FROM `products` WHERE id = '$delete_id'" or die('query failed');
   $res = mysqli_query($conn,$sql);
   header('location:publisher_add.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

  $sql1 = "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'" or die('query failed');
   $res = mysqli_query($conn,$sql1);
   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         $sql = "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'" or die('query failed');
         $res = mysqli_query($conn,$sql);
         
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:publisher_add.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'publisher_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">shop products</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" name="name" class="box" placeholder="enter product name" required>
      <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
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
         <label style = "margin-right: 75%; font-size: 2rem;">Add Image</label>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <label style = "margin-right: 75%; font-size: 2rem;">Add File</label>
      <input type="file" name="file"  class="box" id="upload" required>
      <input type="submit" value="add product" name="upload" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = "SELECT * FROM products WHERE p_id = $PUBLISHER_ID" or die('query failed');
          $res = mysqli_query($conn,$select_products);

         if(mysqli_num_rows($res) > 0){
            while($fetch_products = mysqli_fetch_assoc($res)){
      ?>
      <div class="box">
         <img style = "width:260px;"src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
         <a href="publisher_add.php" class="option-btn">update</a>
         <a href="publisher_add.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = "SELECT * FROM `products` WHERE id = '$update_id'" or die('query failed');
         $res = mysqli_query($conn,$update_query);
         if(mysqli_num_rows($res) > 0){
            while($fetch_update = mysqli_fetch_assoc($res)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
    
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>