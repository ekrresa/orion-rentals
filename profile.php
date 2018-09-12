<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Orion Film Rentals: Profile</title>
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
    include "api/profiles/create.php";
  }

?>
<body>

<?php include 'layout/header.php'; ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <h1 class="display-4">New Profile</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="card card-block form-padding" id="profile-form">
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" name="firstname" value="<?php echo $_SESSION['firstname'] ?>" autofocus required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" name="lastname" value="<?php echo $_SESSION['surname'] ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Phone Number</label>
            <input type="tel" class="form-control" name="phone" maxlength="11" required>
          </div>
          <div class="form-group">
            <label for="name">Address</label>
            <input type="text" class="form-control" name="address" required>
          </div>
          <div class="form-group">
            <label for="name">City</label>
            <input type="text" class="form-control" name="city" required>
          </div>
          <div class="form-group">
            <label for="name">State</label>
            <input type="text" class="form-control" name="state" required>
          </div>

          <button type="submit" class="btn form-btn" name="create">Submit</button>
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