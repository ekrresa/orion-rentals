<?php

$email = "";

if (isset($_POST["login"])) {

	include 'db.php';

	if (empty($_POST["email"])) {
	    $_SESSION['error'] = "<small>Please enter your email address</small><br>";
  }else {
    $email = $conn->escape_string(test_input($_POST["email"]));
  }


  if ($_SESSION['error'] != "") {
  	$_SESSION['error'] = '<div class="alert alert-danger" role="alert"><p><strong>
  	There were error(s) while submitting: </strong></p>' . $_SESSION['error'] . '</div>';
  	header("location: status.php");
  }
  else {

  	$result = $conn->query("SELECT * FROM users WHERE email='$email'");

		if ( $result->num_rows == 0 ){ // User doesn't exist

			$_SESSION['error'] = '<div class="alert alert-danger" role="alert">Your email is not correct</div>';
			header("location: status.php");

		}
		else { // User exists
		    $user = $result->fetch_assoc();

		    if ( password_verify($_POST['password'], $user['password']) ) {

		      $_SESSION['success'] = '<div class="alert alert-success" role="alert">You are logged in.</div>';
		      $_SESSION['name'] = strtoupper($user['password']);
		      header("location: status.php");

		    }
		    else {
		    	$_SESSION['error'] = '<div class="alert alert-danger" role="alert">You have entered wrong password, please try again!</div>';
		    	header("location: status.php");
		    }
		}

  }

}


?>