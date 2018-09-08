<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Orion Film Rentals: About</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/pages.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>

<?php include 'layout/header.php'; ?>

  <div class="container px-3 py-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Status</h1>
    <p><?php

    if( isset($_SESSION['error']) AND !empty($_SESSION['error']) ) {

      echo '<div class="alert alert-danger" role="alert"><p><strong>
      There were error(s) while submitting: </strong></p>' . $_SESSION['error'] . '</div>';

    }

    ?></p>
  </div>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>