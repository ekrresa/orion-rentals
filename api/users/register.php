<?php

use PHPMailer\PHPMailer\PHPMailer;

	if (isset($_POST["signup"])) {

		include_once 'models/User.php';

		// get database connection
		$database = new Database();
		$db = $database->getConnection();

		require 'vendor/autoload.php';

		// prepare user object
		$user = new User($db);

    $user->firstname = $_POST["firstname"];
    $user->lastname = $_POST["lastname"];
    $user->email = $_POST["email"];
    $user->password = $_POST['password'];

    // PHPMailer
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
		$mail->addAddress($user->email, $user->firstname);
		$mail->Subject = 'User Registration';

		$bodyContent = '<h1>Welcome '.$user->firstname.'</h1>';
		$bodyContent .= '<p>Thank you for signing up with us. Below is your username</p><br>';
		$bodyContent .= '<p>Username: '.$user->email.'</p>';
		$mail->Body = $bodyContent;

    //Attempt user registration
    if ( $user->registerUser() && $mail->send() ) {
    	$response["result"] = "success";
      $response["message"] = "User Registered Successfully !";

      $_SESSION["id"] = $user->user_id;
      $_SESSION['firstname'] = $user->firstname;
      $_SESSION['surname'] = $user->lastname;
      $_SESSION['name'] = strtoupper($user->firstname);		
		  header("location: profile.php");
		  return json_encode($response);
	  	exit();
    }
		else {
			if (isset($user->error) && !empty($user->error)) {
				// Registration failed
				$_SESSION["error"] = $user->error;
			} 
			else {
				// Registration mail was not sent
				$_SESSION['error'] = "Unable to confirm your registration. Your network connection may be bad. Please try again later";
				$user->deleteUser();
			}

			$response["result"] = "failure";
      $response["message"] = "Registration Failure";
      header("location: status.php");
      return json_encode($response);
      exit();
		}
	}

?>