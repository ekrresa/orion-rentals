<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Orion Film Rentals: Plans</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/pages.css">
</head>
<body>
	<header class="fixed-top">
		<div class="container-fluid">

    <nav class="navbar navbar-expand-lg">
      <!-- *************NAVBAR LOGO*********** -->
      <a class="navbar-brand title" href="index.php"><i class="fas fa-volleyball-ball"></i>  ORION</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><img src="img/menu-icon.png"></span>
      </button>
      <!-- ***********NAVBAR LINKS************* -->
      <div class="collapse navbar-collapse nav-bar-right" id="navbarTogglerDemo02">
        <ul class="navbar-nav mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="gallery.php">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="plans.php">Plans</a>
          </li>
          <li class="nav-item">
            <?php
              if( isset($_SESSION['success']) && !empty($_SESSION['success']) ):
                  echo '<a class="nav-link" href="users.php?logout=1">Log Out</a>';
              else:
                  echo '<a class="nav-link" href="users.php">Sign In</a>';
              endif;
            ?>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
        </ul>
        <form id="search-form" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search Movies...">
          <button id="search-btn" type="submit" style="display: none;"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </nav>
  </div>
	</header>

  <div class="pricing-header px-3 py-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Plans</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
  </div>

  <div class="container">
    <div class="card-deck mb-3 text-center">
      <div class="card mb-4 box-shadow">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Basic</h4>
        </div>
        <div class="card-body">
          <h5 class="card-title">&#8358;2200 <small class="text-muted">/ month</small></h5>
          <ul class="list-unstyled mt-3 mb-4">
            <li>1 Blockbuster</li>
            <li>4 Other Movies</li>
            <li>No Late Fees</li>
            <li>Free Delivery</li>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <div class="card mb-4 box-shadow">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Premium</h4>
        </div>
        <div class="card-body">
          <h5 class="card-title">&#8358;4500 <small class="text-muted">/ month</small></h5>
          <ul class="list-unstyled mt-3 mb-4">
            <li>2 Blockbusters</li>
            <li>8 Other Movies</li>
            <li>No Late Fees</li>
            <li>Free Delivery</li>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <div class="card mb-4 box-shadow">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Deluxe</h4>
        </div>
        <div class="card-body">
          <h5 class="card-title">&#8358;9000 <small class="text-muted">/ month</small></h5>
          <ul class="list-unstyled mt-3 mb-4">
            <li>All Blockbusters</li>
            <li>16 Other Movies</li>
            <li>No Late Fees</li>
            <li>Free Delivery</li>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>