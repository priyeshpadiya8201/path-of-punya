
<?php 

require_once 'db.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="Shop.css">
<style>
    
@keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        #btnshop {
            animation: fadeIn 1s ease-in-out;
        }
        .input-box{
            animation: fadeIn 1s ease-in-out;
        }
</style>
</head>

<?php include("header.php");?>

<body id="sp2">



<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">SHOP</h1>
            </div>
    </div>    

<!-- 
    <section class="index-category">
    <p>Categories</p>
    <a href="#" class="index-category-box">
        <div class="dark-over"></div>
        <h3>Statue</h3>
    </a>

    <a href="#" class="index-category-box">
        <div class="dark-over"></div>
        <h3>Statue</h3>
    </a>

    <a href="#" class="index-category-box">
        <div class="dark-over"></div>
        <h3>Statue</h3>
    </a>
</section>

<br><br> -->






<div class="container10">
    <div class="rowshop">
        <?php
        // Fetch and display product cards
        $sql = "SELECT * FROM product";
        $all_product = $con->query($sql); 
        $count = 0;
        while($row = mysqli_fetch_assoc($all_product)){
            // if ($count % 3 == 0) {
            //     echo '</div><div class="rowshop">';
            // }
        ?>
        <div class="card" id="btnshop">
            <img src="admin/uploaded_img/<?php echo $row["p_img"];?>" alt="" width="500" height="250">
            <h4><?php echo $row["p_name"];?></h4>
            <p><?php echo $row["p_dec"];?></p>
            <p class="price">₹<?php echo $row["p_price"];?></p>
            <a href="registraction.php?product=<?php echo $row["p_name"];?>&price=<?php echo $row["p_price"];?>" class="btn buynow">BUY NOW</a>
        </div>
        <?php 
            $count++;
        } // End of while loop
        ?>
    </div>
</div>





<script>
      // Function to check login status
      function checkLogi() {
        // Check if the user is logged in
        // You can use any method to determine if the user is logged in, for example, checking for a session variable
        var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        
        if (!isLoggedIn) {
            // If the user is not logged in, redirect them to the login page
            window.location.href = 'login.php'; // Replace 'login.php' with the actual path to your login page
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    // Event listener for buy now button click
    var buyNowButtons = document.querySelectorAll('.buynow');
    buyNowButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Check if user is logged in before proceeding
            if (!checkLogi()) {
                event.preventDefault(); // Prevent default link behavior (redirect)
            }
        });
    });
</script>
</body>
<?php include("footer.php");?>



</html>
