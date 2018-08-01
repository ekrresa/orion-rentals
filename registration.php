<?php
  include("server-validation/regform.php");
  include 'header-footer.php';
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Orion Film Rentals: Registration</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/pages.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>

	<header class="fixed-top">
		<?php head(); ?>
	</header>

	<div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 card card-block bg-light contact-deck">

          <h1>Sign Up!</h1>
          <div id="status"><?php echo $errorMsg.$successMsg; ?></div>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="registration" class="form-padding">
            <div class="form-group">
              <label for="name">First Name</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname;?>" autofocus>
            </div>

            <div class="form-group">
              <label for="name">Last Name</label>
              <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname;?>">
            </div>

            <div class="form-group">
              <label for="name">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>">
            </div>

            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
            </div>

            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
              <label for="name">Confirm Password</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
            </div>

            <button type="submit" id="submit" class="btn form-btn" name="submit">Register</button>
          </form>
        </div>
      </div>
	</div>

  <footer>
    <?php footer() ?>
  </footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- <script src="js/validation.js"></script> -->
</body>
</html>