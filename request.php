<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Orion Film Rentals: Request</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/pages.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<?php

  if ( !isset($_SESSION['name']) && empty($_SESSION['name']) ) {
    header("location: account.php");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "forms/requestform.php";
  }

?>
<body>

<?php include 'layout/header.php'; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1 class="display-4">Movie Request</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" class="card card-block form-padding" id="profile-form">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label>Movie Title</label>
              <input type="text" class="form-control" name="title" autofocus required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label>Genre</label>
              <input type="text" class="form-control" name="genre" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label>Year</label>
              <input type="text" class="form-control" name="year" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label>Cover Image</label>
              <input type="file" class="form-control" name="movie" required>
            </div>
          </div>


          <button type="submit" class="btn form-btn" name="upload">Submit</button>
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