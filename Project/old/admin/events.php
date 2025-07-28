
<?php

 @include 'db.php';

if(isset($_POST['add_product']))
{

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_dec = $_POST['product_dec'];
   $product_loc = $_POST['product_loc'];

   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_loc) || empty($product_dec))
   {
      $message[] = 'please fill out all';
   }
   else
   {
    $insert = "INSERT INTO events(e_name, e_date, e_dec, e_location, e_img) VALUES('$product_name', '$product_price', '$product_dec', '$product_loc', '$product_image')";
    $upload = mysqli_query($con,$insert);
      if($upload)
      {
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new Event added successfully';
      }
      else
      {
         $message[] = 'could not add the Event';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM events WHERE e_id = $id");
   header('location:events.php');
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
         <h3>add a new events</h3>
         <input type="text" placeholder="enter event name" name="product_name" class="box">
         <input type="date" placeholder="enter event date" name="product_price" class="box">
         <input type="text" placeholder="enter event description" name="product_dec" class="box">
         <input type="text" placeholder="enter event location" name="product_loc" class="box">

         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add events">
      </form>
   </div>

   <?php

   $select = mysqli_query($con, "SELECT * FROM events");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>event image</th>
            <th>event name</th>
            <th>event date</th>
            <th>event description</th>
            <th>event location</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select))
         { 
        ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['e_img']; ?>" height="100" alt=""></td>
            <td><?php echo $row['e_name']; ?></td>
            <td><?php echo $row['e_date']; ?></td>
            <td><?php echo $row['e_dec']; ?></td>
            <td><?php echo $row['e_location']; ?></td>
            <td>
               <a href="e_update.php?edit=<?php echo $row['e_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="events.php?delete=<?php echo $row['e_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
</div>
</body>