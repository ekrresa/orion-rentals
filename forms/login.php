<?php

include 'db.php';

/* User login process, checks if user exists and password is correct */
$error = "";
$email = "";

if (isset($_POST["login"])) {

	if (empty($_POST["email"])) {
	    $error .= "<small>Please enter your email address</small><br>";
  }else {
    $email = $conn->escape_string(test_input($_POST["email"]));
  }


  if ($error != "") {
  	$error = '<div class="alert alert-danger" role="alert"><p><strong>
  	There were error(s) while submitting: </strong></p>' . $error . '</div>';
  }
  else {

  	$result = $conn->query("SELECT * FROM users WHERE email='$email'");

		if ( $result->num_rows == 0 ){ // User doesn't exist

			$error = '<div class="alert alert-danger" role="alert">User with that email doesn\'t exist</div>';

		}
		else { // User exists
		    $user = $result->fetch_assoc();

		    if ( password_verify($_POST['password'], $user['password']) ) {

		      $_SESSION['success'] = "Login was successful";
		      header("location: status.php");

		    }
		    else {
		    	$error = '<div class="alert alert-danger" role="alert">You have entered wrong password, please try again!</div>';
		    }
		}

  }

}


?>