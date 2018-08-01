<?php

	function head()
	{
		echo '<div class="container-fluid">

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
	          <a class="nav-link" href="registration.php">Sign Up</a>
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

	</div>';
	}



	function footer()
	{

		echo '<div class="container-fluid">
			<div class="row" id="contact">
				<div class="col-md-12">
					<h2 class="footer-title">Orion Film Rentals</h2>
				</div>
			</div>

			<div class="row footer-color">
				<div class="col-md-5 address">
					<p><i class="fas fa-phone"></i>  +2347036161822</p>
					<p><i class="far fa-envelope"></i>  johndoe@example.com</p>
					<p><i class="fas fa-map-marker-alt"></i>  35A Okota Rd,</p>
					<p>Okota,</p>
					<p>Lagos State.</p>
				</div>

				<div class="col-md-4 address">
					<p>Privacy Policy</p>
					<p>Terms and Conditions</p>
				</div>

				<div class="col-md-3">
					<ul class="social-icons">
						<li><a style="color: #054f96" href="#"><i class="fab fa-facebook-square"></i></a></li>
						<li><a style="color: #5fe0ff" href="#"><i class="fab fa-twitter-square"></i></a></li>
						<li><a style="color: #e208e2" href="#"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>

				<div class="col-md-12 text-center">
					&copy; 2018, Orion Film Rentals
				</div>
			</div>
		</div>';
	}
?>