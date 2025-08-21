<?php
// header.php
// Start session only when not already started to avoid duplicate-session warnings.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// OPTIONAL: set a base URL if your project is in a subfolder (adjust if needed)
// $base = '/Project/Project/old/'; // example
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Temple Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS (adjust path if needed) -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
      .banner-image { background-image: url('b1.jpg'); background-size: cover; }
      /* small fixes */
      nav .nav-link { color: orangered !important; }
      /* optional scrollbar styles or more CSS can go here */
    </style>
</head>
<body>
  <!-- Navbar  -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
    <div class="container">
      <a href="Home.php" class="navbar-brand">
        <img src="1.png" id="lo1" height="60" alt="Logo">
      </a>

      <button class="navbar-toggler" type="button"
              data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="mx-auto"></div>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="Home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="Donation.php">Donation</a></li>
          <li class="nav-item"><a class="nav-link" href="temple.php">Temples</a></li>
          <li class="nav-item"><a class="nav-link" href="Shop.php">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="Events.php">Events</a></li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php" id="login">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php" id="login">Login</a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>

  <!-- leave it to the including page to output page content and the closing body/html tags -->
  <!-- Ensure you include bootstrap bundle before the closing body tag in the page that includes header.php -->
