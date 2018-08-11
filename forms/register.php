<?php

	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$firstname = $lastname = $email = $password = "";

		// *************SERVER VALIDATION***************
	if (isset($_POST["signup"])) {

		include 'db.php'; //Database connection

		if (empty($_POST["firstname"])) {
	    $_SESSION['error'] .= "<small>Please enter your first name</small><br>";
	  } else {
	    $firstname = $conn->escape_string(test_input($_POST["firstname"]));
	  }

	  if (empty($_POST["lastname"])) {
	    $_SESSION['error'] .= "<small>Please enter your surname</small><br>";
	  } else {
	    $lastname = $conn->escape_string(test_input($_POST["lastname"]));
	  }

	  if (empty($_POST["email"])) {
	    $_SESSION['error'] .= "<small>Please enter your email address</small><br>";
	  }
	  elseif ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		  $_SESSION['error'] .= "<small>The email address entered is invalid.</small><br>";
		}
	  else {
	    $email = $conn->escape_string(test_input($_POST["email"]));
	  }

	  if (empty($_POST["password"])) {
	    $_SESSION['error'] .= "<small>Please your password is required.</small><br>";
	  }else {
	  	$password = $conn->escape_string(password_hash(test_input($_POST['password']), PASSWORD_BCRYPT));
	  }


	  if ($_SESSION['error'] != "") {
	  	$_SESSION['error'] = '<div class="alert alert-danger" role="alert"><p><strong>
	  	There were error(s) while submitting: </strong></p>' . $_SESSION['error'] . '</div>';
	  	header("location: status.php");
	  }
	  else {

	  	// Check if user with that email already exists
			$result = $conn->query("SELECT * FROM users WHERE email='$email'") or die($conn->error());

			// We know user email exists if the rows returned are more than 0
			if ( $result->num_rows > 0 ) {

				$_SESSION['error'] = '<div class="alert alert-danger" role="alert">User with this email already exists</div>';
				header("location: status.php");

			}
			else { // Email doesn't already exist in a database, proceed...

		    $sql = "INSERT INTO users (firstname, lastname, email, password) "
		            . "VALUES ('$firstname','$lastname','$email','$password')";

		    // Add user to the database
		    if ( $conn->query($sql) ){
		    	$firstname = $lastname = $email = $password = "";
		  		$_SESSION['success'] = '<div class="alert alert-success" role="alert">User registered successfully</div>';
		  		header("location: status.php");
		    }

		    else {
	        $_SESSION['error'] = '<div class="alert alert-danger" role="alert">User with this email already exists</div>';
	        header("location: status.php");
		    }

			}

		}

	}

?>