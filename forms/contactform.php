<?php

//Import PHPMailer classes into the global namespace
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	$errorMsg = $successMsg = "";
	$name = $email = $message = "";//Initialise form values

	if (isset($_POST["submit"])) {

		// *************SERVER VALIDATION***************
		if (empty($_POST["name"])) {
	    $errorMsg .= "<small>Please enter your name</small><br>";
	  } else {
	    $name = test_input($_POST["name"]);
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

	  if (empty($_POST["message"])) {
	    $errorMsg .= "<small>A message is required.</small><br>";
	  }
	  else {
	  	$message = test_input($_POST["message"]);
	  }


	  if ($errorMsg != "") {
	  	$errorMsg = '<div class="alert alert-danger" role="alert"><p><strong>
	  	There were error(s) while submitting: </strong></p>' . $errorMsg . '</div>';
	  }
	  else {

			date_default_timezone_set("Africa/Lagos");
	  	$nowTime = date('Y-m-d h:i:sa');

	  	$text = "$name,$email,$message,$nowTime";

	  	// **********APPEND USER DETAILS TO DATABASE**********
	  	$file = fopen("database/contact.csv","a");
			fputcsv($file, explode(",", $text));
			fclose($file);

			// ***********GET INFORMATION FROM DATABASE****************
			$csv = array_map("str_getcsv", file("database/contact.csv"));
			$name = $csv[sizeof($csv)-1][0];
			$email = $csv[sizeof($csv)-1][1];
			$message = $csv[sizeof($csv)-1][2];

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
			$mail->AddAddress($email, $name);
			$mail->isHTML(true);
			$mail->Subject = "Orion Film Rentals: Message";
			$bodyContent = "<h1>Message Delivered Successfully</h1>";
			$bodyContent .= '<p>We will get back to you as soon as possible.<br>Below is a copy of your message:</p>';
			$bodyContent .= "<p><strong>".$message."</strong></p>";
			$mail->Body = $bodyContent;

			//send the mail, check for errors
			if($mail->Send()) {

				$name = $email = $message = "";
			  $successMsg = '<p class="alert alert-success" role="alert">Your message was sent. We will get back to you ASAP!</p>';

			} else {

			  $errorMsg = '<p class="alert alert-danger" role="alert">'.$mail->ErrorInfo.'</p>';

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