<?php
// Start session at the very top before any HTML output
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shop page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Shop.css">
    <style>
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        #btnshop, .input-box { animation: fadeIn 1s ease-in-out; }
        .card {
            margin: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }
        .price {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body id="sp2">

<?php include("header.php"); ?>

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">SHOP</h1>
    </div>
</div>    

<div class="container10">
    <div class="rowshop d-flex flex-wrap">
        <?php
        $sql = "SELECT * FROM product";
        $all_product = $con->query($sql); 
        while($row = mysqli_fetch_assoc($all_product)){
        ?>
        <div class="card" id="btnshop" style="width: 18rem;">
            <img src="admin/uploaded_img/<?php echo htmlspecialchars($row["p_img"]); ?>" 
                 alt="<?php echo htmlspecialchars($row["p_name"]); ?>" 
                 class="card-img-top" height="180">
            <div class="card-body">
                <h4><?php echo htmlspecialchars($row["p_name"]); ?></h4>
                <p><?php echo htmlspecialchars($row["p_dec"]); ?></p>
                <p class="price">₹<?php echo number_format($row["p_price"], 2); ?></p>
                <a href="buy.php?id=<?php echo urlencode($row["p_id"]); ?>" class="btn btn-primary buynow">BUY NOW</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    function checkLogi() {
        var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        if (!isLoggedIn) {
            window.location.href = 'login.php';
            return false;
        }
        return true;
    }
    document.querySelectorAll('.buynow').forEach(function(button) {
        button.addEventListener('click', function(event) {
            if (!checkLogi()) {
                event.preventDefault();
            }
        });
    });
</script>

<?php include("footer.php"); ?>
</body>
</html>
