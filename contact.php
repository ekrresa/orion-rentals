<?php
  include("server-validation/contactform.php");
  include 'header-footer.php';
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Orion Film Rentals: Contact</title>
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

          <h1>Contact Us!</h1>
          <div id="status"><?php echo $errorMsg.$successMsg; ?></div>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="contact" class="form-padding">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="<?php echo $name;?>" autofocus required>
            </div>

            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
            </div>

            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" rows="4" name="message" value="<?php echo $message;?>" required></textarea>
            </div>

            <button type="submit" id="submit" name="submit" class="btn form-btn">Submit</button>
          </form>
        </div>
      </div>
	</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>