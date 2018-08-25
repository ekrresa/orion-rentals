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
	if (isset($_POST["submit"])) {

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

	  if (empty($_POST["phone"])) {
	    $_SESSION['error'] .= "<small>Please enter your phone number</small><br>";
	  }
	  else {
	    $phone = $conn->escape_string(test_input($_POST["phone"]));
	  }

	  if (empty($_POST["address"])) {
	    $_SESSION['error'] .= "<small>Please enter your address</small><br>";
	  }
	  else {
	    $address = $conn->escape_string(test_input($_POST["address"]));
	  }

	  if (empty($_POST["city"])) {
	    $_SESSION['error'] .= "<small>Please enter your city</small><br>";
	  }
	  else {
	    $city = $conn->escape_string(test_input($_POST["city"]));
	  }

	  if (empty($_POST["state"])) {
	    $_SESSION['error'] .= "<small>Please enter your state number</small><br>";
	  }
	  else {
	    $state = $conn->escape_string(test_input($_POST["state"]));
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
				date_default_timezone_set("Africa/Lagos");
				$regdate = date("Y-m-d H:i:s");

		    $sql = "INSERT INTO users (firstname, lastname, email, password, reg_date) "
		            . "VALUES ('$firstname','$lastname','$email','$password', '$regdate')";

		    // Add user to the database
		    if ( $conn->query($sql) ){
		    	$mail = new PHPMailer;

		    	$mail->isSMTP();
					$mail->Host = 'smtp.gmail.com';
					$mail->SMTPAuth = true;
					$mail->Username = 'ekrresaochuko@gmail.com';
					$mail->Password = 'Aurora@845';
					$mail->SMTPSecure = 'tls';
					$mail->Port = 587;
					$mail->isHTML(true);

					$mail->setFrom('ekrresaochuko@gmail.com', 'Orion Film Rentals');
					$mail->addAddress($email, $firstname);
					$mail->Subject = 'User Registration';

					$bodyContent = '<h1>Welcome '.$firstname.'</h1>';
					$bodyContent .= '<p>Thank you for signing up with us. Below is your username</p><br>';
					$bodyContent .= '<p>Username: '.$email.'</p>';
					$mail->Body = $bodyContent;

					if(!$mail->send()) {
				    $_SESSION['error'] = '<div class="alert alert-danger" role="alert">Mail error. Not to worry though, you are registered</div>';
	        	header("location: status.php");
					} else {
					  $_SESSION['success'] = '<div class="alert alert-success" role="alert">User registered successfully. Check your mail for your login details.</div>';
					  $_SESSION['name'] = strtoupper($firstname);
		  			header("location: profile.php");
					}
				}

		    else {
	        $_SESSION['error'] = '<div class="alert alert-danger" role="alert">User with this email already exists</div>';
	        header("location: status.php");
		    }

			}

		}

	}

?>