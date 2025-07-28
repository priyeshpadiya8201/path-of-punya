<?php
// Check if the product name and price parameters are set in the URL
if(isset($_GET['product']) && isset($_GET['price'])){
    // Retrieve the product name and price from the URL
    $productName = $_GET['product'];
    $productPrice = $_GET['price'];
}


$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"test");

//   echo"<script>alert('con done')</script>";


  if(isset($_POST["place"]))
  { 
    //reg
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $m_number = $_POST['m_number'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $pincode = $_POST['pincode'];
    //order
  $o_name = $_POST['o_name'];
  $o_amt = $_POST['o_amt'];
  $p_method = $_POST['p_method'];
  $c_name = $_POST['c_name'];
  $c_no = $_POST['c_no'];
  $exp_m = $_POST['exp_m'];
  $exp_y = $_POST['exp_y'];
  $c_cvv = $_POST['c_cvv'];

  
  // insert query reg

  $query = "INSERT INTO `registraction`(`id`, `fullname`, `email`, `address`, `m_number`, `city`, `state`, `pincode`) VALUES ('','$fullname','$email','$address','$m_number','$city','$state','$pincode')";

  $temp=mysqli_query($con,$query) or die(mysqli_error($con));
    if($temp==1)
    {
  //insert query order
  $query = "INSERT INTO `order`(`o_id`, `o_name`, `o_amt`, `p_method`, `c_name`, `c_no`, `exp_m`, `exp_y`, `c_cvv`) VALUES ('','$o_name','$o_amt','$p_method','$c_name','$c_no','$exp_m','$exp_y','$c_cvv')";
    $tem=mysqli_query($con,$query) or die(mysqli_error($con));
    if($tem==1)
    {
      echo "order done";
    }
  }
  else{
    echo "order not done";
  }
  echo"<script type='text/javascript'> alert('donation successfully')</script>";
  mysqli_close($con);
  header("Location: succees.php");
  exit;
  
   
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
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

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

#expmonth {
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


/* a {
  color: #2196F3;
} */

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}
.row {
  display: flex;
  flex-wrap: wrap;
}

.col-50 {
  flex: 50%;
}

.payment-option {
  display: inline-block;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
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
  #btn{
    width: 100%;
  }
  
  .btn:hover {
    background-color: orangered;
  }

</style>
</head>
<body>

<div class="row">
  <div class="col-75">
    <div class="container">

    <form method="POST" onsubmit="return validateForm()">

      
        <div class="row">
          <div class="col-50">
          
        <h3>Product Details</h3>
        <label for="product">Product Name:</label>
        <input type="text" id="product" name="o_name" value="<?php echo $productName; ?>" readonly>
        <label for="price">Price:</label>
        <input type="text" id="price" name="o_amt" value="<?php echo $productPrice; ?>" readonly>
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="fullname" placeholder="soneji sagar v.">

            


            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="wammu12@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="plot no 542 W. 15th Street ">

            
            <label for="mobileNo"><i class="fa fa-mobile mobile-icon"></i> Mobile No</label>
            <input type="text" id="mobileNo" name="m_number" pattern="[0-9]{10}" maxlength="10" required>

            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="rajkot" required>

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="Gujrat" required>
              </div>
              <div class="col-50">
                <label for="zip">Pincode</label>
                <input type="text" id="pincode" name="pincode" maxlength="6"  required>
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
            <bR><br>


            <div id="payment-fields">
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="c_name" placeholder="soneji sagar vijaykumar">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="c_no" placeholder="1111-2222-3333-4444" maxlength="16">

            <label for="expmonth">Exp Month</label>
            <!-- <input type="text" id="expmonth" name="exp_m" placeholder="September"> -->
            <select id="expmonth" name="exp_m" id="expmonth">
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
                <input type="text" id="expyear" name="exp_y" placeholder="2030" >
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="c_cvv" maxlength="3" placeholder="352" >
              </div>


            </div>
          </div>

          
          
        </div>
        

        <button type="submit" name="place" value="don" class="btn" >place order</button>

        <a href="shop.php" id="btn" ><input type="button" class="btn" value="back"  ></a>
      </form>
      
    </div>
  </div>

</div>
<script>
    
function showPaymentFields() {
  document.getElementById("payment-fields").style.display = "block";
}

function hidePaymentFields() {
  document.getElementById("payment-fields").style.display = "none";
}
function validateForm() {
    console.log("Validation started.");

    var fname = document.getElementById("fname").value;
    var email = document.getElementById("email").value;
    var adr = document.getElementById("adr").value;
    var city = document.getElementById("city").value;
    var state = document.getElementById("state").value;
    var zip = document.getElementById("pincode").value;
    var paymentMethod = document.querySelector('input[name="p_method"]:checked');

    if (fname.trim() == "" || email.trim() == "" || adr.trim() == "" || city.trim() == "" || state.trim() == "" || zip.trim() == "") {
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
        return true; // Allow form submission without further validation for cash on delivery
    }

    // For credit card and debit card, validate the credit card fields
    var cname = document.getElementById("cname").value;
    var ccnum = document.getElementById("ccnum").value;
    var expmonth = document.getElementById("expmonth").value;
    var expyear = document.getElementById("expyear").value;
    var cvv = document.getElementById("cvv").value;

    if (!cname || !ccnum || !expmonth || !expyear || !cvv) {
        alert("All card fields must be filled out");
        return false;
    }

    var currentYear = new Date().getFullYear();
    if (parseInt(expyear) < currentYear) 
    {
      alert("Please select an expiration year that is equal to or greater than the current year.");
      return false;
    }
  
    console.log("Validation completed successfully.");
    return true;
}
</script>
</body>
</html>
