<?php

  require_once("db.php");
  
  
?>

<!DOCTYPE html>
<html>
<head>
    <title>Events Page</title>

<link rel="stylesheet" href="events.css">
<style>


@keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .event-details {
            animation: fadeIn 1s ease-in-out;
        }
        .input-box{
            animation: fadeIn 1s ease-in-out;
        }


</style>

</head>
<?php include("header.php");?>
<body id="evb">

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">EVENTS</h1>
            </div>
    </div>    
    <?php
        // Fetch and display product cards
        $sql = "SELECT * FROM events";
        $all_product = $con->query($sql);
        while($row = mysqli_fetch_assoc($all_product)){
        ?>
<form method="POST">
<div class="event-details">
        <h1><?php echo $row["e_name"];?></h1>
        <img src="admin/uploaded_img/<?php echo $row["e_img"];?>" height="200px" width="300px" alt="Moonlight Gala" class="event-image">
        <br><br>
        <h3>Events Location</h3>
        <p class="event-loc"><?php echo $row["e_location"];?></p>
        <h3>Events date</h3>
        <h5><?php echo $row["e_date"];?></h5> 
        <br><h2>Description</h2>

        <p class="event-dec"><?php echo $row["e_dec"];?></p>
    </div>

</form>
<?php
}
?>

<script src="confetti.js"></script>
    
<script>

// start

const start = () => {
    setTimeout(function() {
        confetti.start()
    }, 100); // 1000 is time that after 1 second start the confetti ( 1000 = 1 sec)
};

//  Stop

const stop = () => {
    setTimeout(function() {
        confetti.stop()
    }, 1500); // 5000 is time that after 5 second stop the confetti ( 5000 = 5 sec)
};

start();
stop();
</script>

</body>
<?php include("footer.php");?>

</html>
