
<?php

 @include 'db.php';

if(isset($_POST['add_product']))
{

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_dec = $_POST['product_dec'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_dec))
   {
      $message[] = 'please fill out all';
   }
   else
   {
      $insert = "INSERT INTO product(p_name,p_price,p_dec,p_img) VALUES('$product_name', '$product_price','$product_dec', '$product_image')";
      $upload = mysqli_query($con,$insert);
      if($upload)
      {
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }
      else
      {
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM product WHERE p_id = $id");
   header('location:product.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">


	<title>AdminHub</title>
</head>


<body>
<?php include("index.php");?>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">
   <div class="admin-product-form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="text" placeholder="enter product description" name="product_dec" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>
   </div>

   <?php

   $select = mysqli_query($con, "SELECT * FROM product");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>product description</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select))
         { 
        ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['p_img']; ?>" height="100" alt=""></td>
            <td><?php echo $row['p_name']; ?></td>
            <td>$<?php echo $row['p_price']; ?>/-</td>
            <td><?php echo $row['p_dec']; ?></td>

            <td>
               <a href="admin_update.php?edit=<?php echo $row['p_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="product.php?delete=<?php echo $row['p_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
</div>
</body>