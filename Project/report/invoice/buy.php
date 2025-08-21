<?php
include("connect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: shop.php");
    exit;
}

$product_id = intval($_GET['id']);
$sql = "SELECT * FROM product WHERE p_id = $product_id";
$result = $con->query($sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found!";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buy Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="buy_shop.css">
</head>
<body>
<?php include("header.php"); ?>

<div class="container mt-5">
    <div class="product-box">
        <h3><?php echo $product['p_name']; ?></h3>
        <img src="admin/uploaded_img/<?php echo $product['p_img']; ?>" alt="" class="product-image">
        <p><?php echo $product['p_dec']; ?></p>
        <p class="price">Price: ₹<span id="price"><?php echo $product['p_price']; ?></span></p>

        <!-- Updated Form -->
        <form action="  registraction.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['p_id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['p_name']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['p_price']; ?>">

            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control qty-input">
            </div>

            <p class="total">Grand Total: ₹<span id="grandtotal"><?php echo $product['p_price']; ?></span></p>

            <button type="submit" class="btn btn-success btn-purchase">Confirm Purchase</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('quantity').addEventListener('input', function() {
        let price = parseFloat(document.getElementById('price').innerText);
        let qty = parseInt(this.value) || 1;
        document.getElementById('grandtotal').innerText = (price * qty).toFixed(2);
    });
</script>

<?php include("footer.php"); ?>
</body>
</html>
