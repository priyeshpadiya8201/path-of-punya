<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check required product info
    if (
        !isset($_POST['product_id']) || 
        !isset($_POST['product_name']) || 
        !isset($_POST['price']) || 
        !isset($_POST['quantity'])
    ) {
        header("Location: shop.php");
        exit;
    }

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $grand_total = $price * $quantity;
} else {
    header("Location: shop.php");
    exit;
}

$con = new mysqli("localhost", "root", "", "test");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['place'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $m_number = trim($_POST['m_number'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');

    $o_name = trim($_POST['o_name'] ?? '');
    $o_amt = trim($_POST['o_amt'] ?? '');
    $p_method = trim($_POST['p_method'] ?? '');
    $c_name = trim($_POST['c_name'] ?? '');
    $c_no = trim($_POST['c_no'] ?? '');
    $exp_m = trim($_POST['exp_m'] ?? '');
    $exp_y = trim($_POST['exp_y'] ?? '');
    $c_cvv = trim($_POST['c_cvv'] ?? '');

    // Basic validation on server side too
    if (empty($fullname) || empty($email) || empty($address) || empty($m_number) || empty($city) || empty($state) || empty($pincode) || empty($p_method)) {
        echo "<script>alert('Please fill all required fields.');</script>";
    } else {
        $stmt = $con->prepare("INSERT INTO registraction (fullname, email, address, m_number, city, state, pincode) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fullname, $email, $address, $m_number, $city, $state, $pincode);

        if ($stmt->execute()) {
            $stmt->close();

            $stmt2 = $con->prepare("INSERT INTO `order` (o_name, o_amt, p_method, c_name, c_no, exp_m, exp_y, c_cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param("ssssssss", $o_name, $o_amt, $p_method, $c_name, $c_no, $exp_m, $exp_y, $c_cvv);

            if ($stmt2->execute()) {
                $stmt2->close();
                $con->close();

                $_SESSION['order'] = [
                    'product_name' => $o_name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total_price' => $grand_total,
                    'fullname' => $fullname,
                    'email' => $email,
                    'address' => $address,
                    'm_number' => $m_number,
                    'city' => $city,
                    'state' => $state,
                    'pincode' => $pincode,
                    'payment_method' => $p_method
                ];

                header("Location: invoice.php");
                exit;
            } else {
                echo "<script>alert('Failed to place order. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Failed to save registration data. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Place Your Order</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<style>
body {
  font-family: Arial, sans-serif;
  font-size: 17px;
  padding: 8px;
}
* {
  box-sizing: border-box;
}
.row {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -16px;
}
.col-25 {
  flex: 25%;
}
.col-50 {
  flex: 50%;
}
.col-75 {
  flex: 75%;
}
.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}
.container {
  background-color: #e0f2f1;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}
input[type=text], input[type=email], input[type=tel], select {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
label {
  margin-bottom: 10px;
  display: block;
}
.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}
hr {
  border: 1px solid lightgrey;
}
span.price {
  float: right;
  color: grey;
}
.payment-option {
  display: inline-block;
}
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
.btn {
  background-color: orange;
  color: white;
  text-decoration: none;
  text-align: center;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}
.btn:hover {
  background-color: orangered;
}
</style>
<script>
function showPaymentFields() {
  document.getElementById('payment-fields').style.display = 'block';
}
function hidePaymentFields() {
  document.getElementById('payment-fields').style.display = 'none';
}
function validateForm() {
  var fname = document.getElementById("fname").value.trim();
  var email = document.getElementById("email").value.trim();
  var adr = document.getElementById("adr").value.trim();
  var city = document.getElementById("city").value.trim();
  var state = document.getElementById("state").value.trim();
  var zip = document.getElementById("pincode").value.trim();
  var paymentMethod = document.querySelector('input[name="p_method"]:checked');

  if (fname === "" || email === "" || adr === "" || city === "" || state === "" || zip === "") {
      alert("All fields must be filled out");
      return false;
  }
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
      alert("Please enter a valid email address");
      return false;
  }
  if (!paymentMethod) {
      alert("Please select a payment method.");
      return false;
  }
  if (paymentMethod.value === "cash on delivery") {
      return true;
  }
  var cname = document.getElementById("cname").value.trim();
  var ccnum = document.getElementById("ccnum").value.trim();
  var expmonth = document.getElementById("expmonth").value.trim();
  var expyear = document.getElementById("expyear").value.trim();
  var cvv = document.getElementById("cvv").value.trim();

  if (!cname || !ccnum || !expmonth || !expyear || !cvv) {
      alert("All card fields must be filled out");
      return false;
  }
  var currentYear = new Date().getFullYear();
  if (parseInt(expyear) < currentYear) {
    alert("Please select an expiration year that is equal to or greater than the current year.");
    return false;
  }
  return true;
}

function confirmAndSubmit(form) {
  if (!validateForm()) {
    return false;
  }
  if (confirm("Your order confirm. Proceed?")) {
    form.submit();
    return true;
  }
  return false;
}
</script>
</head>
<body>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="POST" action="" onsubmit="return confirmAndSubmit(this)">
        <div class="row">
          <div class="col-50">
            <h2>Purchase Summary</h2>
            <p><strong>Product Name:</strong> <?php echo htmlspecialchars($product_name); ?></p>
            <p><strong>Price per unit:</strong> ₹<?php echo number_format($price, 2); ?></p>
            <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
            <p><strong>Total Price:</strong> ₹<?php echo number_format($grand_total, 2); ?></p>

            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">

            <input type="hidden" name="o_name" value="<?php echo htmlspecialchars($product_name); ?>">
            <input type="hidden" name="o_amt" value="<?php echo htmlspecialchars($grand_total); ?>">

            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="fullname" placeholder="John Doe" required>

            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" placeholder="john@example.com" required>

            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>

            <label for="mobileNo"><i class="fa fa-mobile mobile-icon"></i> Mobile No</label>
            <input type="tel" id="mobileNo" name="m_number" pattern="[0-9]{10}" maxlength="10" placeholder="9876543210" required>

            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="City" required>

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="State" required>
              </div>
              <div class="col-50">
                <label for="pincode">Pincode</label>
                <input type="text" id="pincode" name="pincode" maxlength="6" placeholder="123456" required>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="payment">Payment Method</label><br>

            <label class="payment-option" for="credit">Credit Card</label>
            <input type="radio" id="credit" name="p_method" value="credit card" onclick="showPaymentFields()" required> 

            <label class="payment-option" for="debit">Debit Card</label>
            <input type="radio" id="debit" name="p_method" value="debit card" onclick="showPaymentFields()" required> 

            <label class="payment-option" for="cash">Cash on Delivery</label>
            <input type="radio" id="cash" name="p_method" value="cash on delivery" onclick="hidePaymentFields()" required>

            <br><br>

            <div id="payment-fields" style="display:none;">
              <label for="cname">Name on Card</label>
              <input type="text" id="cname" name="c_name" placeholder="John Doe">

              <label for="ccnum">Credit card number</label>
              <input type="text" id="ccnum" name="c_no" placeholder="1111-2222-3333-4444" maxlength="16">

              <label for="expmonth">Exp Month</label>
              <select name="exp_m" id="expmonth">
                <option value="">Select Expire Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>

              <div class="row">
                <div class="col-50">
                  <label for="expyear">Exp Year</label>
                  <input type="text" id="expyear" name="exp_y" placeholder="2030">
                </div>
                <div class="col-50">
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" name="c_cvv" maxlength="3" placeholder="352">
                </div>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" name="place" class="btn">Place Order</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
