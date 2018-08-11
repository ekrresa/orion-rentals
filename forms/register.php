<?php
	include 'db.php';
	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$firstname = $lastname = $email = $password = "";
	$error = "";

		// *************SERVER VALIDATION***************
	if (isset($_POST["signup"])) {

		if (empty($_POST["firstname"])) {
	    $error .= "<small>Please enter your first name</small><br>";
	  } else {
	    $firstname = $conn->escape_string(test_input($_POST["firstname"]));
	  }

	  if (empty($_POST["lastname"])) {
	    $error .= "<small>Please enter your surname</small><br>";
	  } else {
	    $lastname = $conn->escape_string(test_input($_POST["lastname"]));
	  }

	  if (empty($_POST["email"])) {
	    $error .= "<small>Please enter your email address</small><br>";
	  }
	  elseif ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		  $error .= "<small>The email address entered is invalid.</small><br>";
		}
	  else {
	    $email = $conn->escape_string(test_input($_POST["email"]));
	  }

	  if (empty($_POST["password"])) {
	    $error .= "<small>Please your password is required.</small><br>";
	  }else {
	  	$password = $conn->escape_string(password_hash(test_input($_POST['password']), PASSWORD_BCRYPT));
	  }


	  if ($error != "") {
	  	$error = '<div class="alert alert-danger" role="alert"><p><strong>
	  	There were error(s) while submitting: </strong></p>' . $error . '</div>';
	  }
	  else {

	  	// Check if user with that email already exists
			$result = $conn->query("SELECT * FROM users WHERE email='$email'") or die($conn->error());

			// We know user email exists if the rows returned are more than 0
			if ( $result->num_rows > 0 ) {

				$error = '<div class="alert alert-danger" role="alert">User with this email already exists</div>';

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
	        $error = '<div class="alert alert-danger" role="alert">User with this email already exists</div>';
		    }

			}

		}

	}

?>