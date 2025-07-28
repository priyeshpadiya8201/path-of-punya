<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>temple website
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
      .banner-image {
        background-image: url('b1.jpg');
        background-size: cover;
      }
      /* scollbar */
    </style>
  </head>
  <body>
    <!-- Navbar  -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
      <div class="container">
      <a href="Home.php" class="logo"><img src="1.png" id="lo1" height="90vh"></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
          background color="blue"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mx-auto"></div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " id="ha1" href="Home.php" style="color:orangered">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="ha1" href="Donation.php" style="color:orangered">Donation</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="ha1" href="temple.php" style="color:orangered">Temples</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="ha1" href="Shop.php" style="color:orangered">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="ha1" href="Events.php" style="color:orangered">Events</a>
            </li>
            <li class="nav-item">
            <?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in, get the username from the session
    // $username = $_SESSION['username'];
    // Display the logout button
    echo '<a href="logout.php" class="nav-link" id="login">Logout</a>';
} else {
    // User is not logged in, display the login button
    echo '<a href="login.php" class="nav-link" id="login">Login</a>';
}
?>

          </ul>
        </div>
      </div>
    </nav>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      var nav = document.querySelector('nav');

      window.addEventListener('scroll', function () {
        if (window.pageYOffset > 100) {
          nav.classList.add('bg-dark', 'shadow');
        } else {
          nav.classList.remove('bg-dark', 'shadow');
        }
      });
    </script>
    
  </body>
</html>