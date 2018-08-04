<?php

//Import PHPMailer classes into the global namespace
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	$errorMsg = $successMsg = "";
	$firstname = $lastname = $phone = $email = $password = $confirmpassword = "";

	if (isset($_POST["submit"])) {

		// *************SERVER VALIDATION***************
		if (empty($_POST["firstname"])) {
	    $errorMsg .= "<small>Please enter your first name</small><br>";
	  } else {
	    $firstname = test_input($_POST["firstname"]);
	  }

	  if (empty($_POST["lastname"])) {
	    $errorMsg .= "<small>Please enter your surname</small><br>";
	  } else {
	    $lastname = test_input($_POST["lastname"]);
	  }

	  if (empty($_POST["phone"])) {
	    $errorMsg .= "<small>Please enter your phone number</small><br>";
	  } else {
	    $phone = test_input($_POST["phone"]);
	  }

	  if (empty($_POST["email"])) {
	    $errorMsg .= "<small>Please enter your email address</small><br>";
	  }
	  elseif ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		  $errorMsg .= "<small>The email address entered is invalid.</small><br>";
		}
	  else {
	    $email = test_input($_POST["email"]);
	  }

	  if (empty($_POST["password"])) {
	    $errorMsg .= "<small>Please your password is required.</small><br>";
	  }
	  elseif (empty($_POST["confirmpassword"])) {
	    $errorMsg .= "<small>Please confirm your password</small><br>";
	  }
	  else {
	  	$password = test_input($_POST["password"]);
	    $confirmpassword = test_input($_POST["confirmpassword"]);
	  }

	  if($password != $confirmpassword) {
	  	$errorMsg .= "<small>Your passwords do not match. Please try again</small>";
	  }


	  if ($errorMsg != "") {
	  	$errorMsg = '<div class="alert alert-danger" role="alert"><p><strong>
	  	There were error(s) while submitting: </strong></p>' . $errorMsg . '</div>';
	  }
	  else {

			date_default_timezone_set("Africa/Lagos");
	  	$nowTime = date('Y-m-d h:i:sa');

	  	$text = "$firstname,$lastname,$phone,$email,$password,$nowTime";

	  	// **********APPEND USER DETAILS TO DATABASE**********
	  	$file = fopen("database/users.csv","a");
			fputcsv($file, explode(",", $text));
			fclose($file);

			// ***********GET INFORMATION FROM DATABASE****************
			$csv = array_map("str_getcsv", file("database/users.csv"));
			$firstname = $csv[sizeof($csv)-1][0];
			$email = $csv[sizeof($csv)-1][3];
			$password = $csv[sizeof($csv)-1][4];

			//Create a new PHPMailer instance
			$mail = new PHPMailer;

			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;
			$mail->Username = "ekrresaochuko@gmail.com";
			$mail->Password = "Aurora@845";

			$mail->setFrom("ekrresaochuko@gmail.com", "Orion Film Rentals");
			$mail->AddAddress($email, $firstname);
			$mail->isHTML(true);
			$mail->Subject = "Orion Film Rentals: Sign Up Information";
			$bodyContent = "<h1>Thank you for signing up to Orion Film Rentals</h1>";
			$bodyContent .= '<p>Your username is '.$email.'<br>Your password is '.$password.'</p>';
			$mail->Body = $bodyContent;

			//send the mail, check for errors
			if($mail->Send()) {

				$firstname = $lastname = $phone = $email = "";
			  $successMsg = '<p class="alert alert-success" role="alert">Your registration was successful. Please check your mail for your login details</p>';

			} else {

			  $errorMsg = '<p class="alert alert-danger" role="alert">There was an error. Please try again</p>';

			}
	  }

	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>