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
          <div id="status"><?php echo $errorMsg.$successMsg; ?></div>
          <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Login</a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="signupform" class="form-padding">
                <div class="form-group">
                  <label for="name">First Name</label>
                  <input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>" autofocus required>
                </div>

                <div class="form-group">
                  <label for="name">Last Name</label>
                  <input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>" required>
                </div>

                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
                </div>

                <div class="form-group">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" id="btn-signup" class="btn form-btn" name="btn-signup">Sign Up</button>
              </form>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="loginform" class="form-padding">

                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
                </div>

                <div class="form-group">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" id="btn-login" class="btn form-btn" name="btn-login">Log In</button>
              </form>

            </div>
          </div>

        </div>
      </div>
	</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>