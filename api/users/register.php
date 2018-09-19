<?php
	// use PHPMailer\PHPMailer\PHPMailer;

	if (isset($_POST["signup"])) {

		// require 'vendor/autoload.php';
		include_once 'models/User.php';

		// get database connection
		$database = new Database();
		$db = $database->getConnection();

		// prepare user object
		$user = new User($db);

    $user->firstname = $_POST["firstname"];
    $user->lastname = $_POST["lastname"];
    $user->email = $_POST["email"];
    $user->password = $_POST['password'];

    //Attempt user registration
		$result = $user->registerUser();

		if ($result) {
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
			$response["result"] = "failure";
      $response["message"] = "Registration Failure";
      $_SESSION['error'] = $user->error;
      header("location: status.php");
      return json_encode($response);
      exit();
		}
	}
	// 	    	$mail = new PHPMailer;

	// 	    	$mail->isSMTP();
	// 				$mail->Host = 'smtp.gmail.com';
	// 				$mail->SMTPAuth = true;
	// 				$mail->Username = 'ekrresaochuko@gmail.com';
	// 				$mail->Password = 'Aurora@845';
	// 				$mail->SMTPSecure = 'tls';
	// 				$mail->Port = 587;
	// 				$mail->isHTML(true);

	// 				$mail->setFrom('ekrresaochuko@gmail.com', 'Orion Film Rentals');
	// 				$mail->addAddress($email, $firstname);
	// 				$mail->Subject = 'User Registration';

	// 				$bodyContent = '<h1>Welcome '.$firstname.'</h1>';
	// 				$bodyContent .= '<p>Thank you for signing up with us. Below is your username</p><br>';
	// 				$bodyContent .= '<p>Username: '.$email.'</p>';
	// 				$mail->Body = $bodyContent;

	// 				if(!$mail->send()) {
	// 			    $_SESSION['error'] = '<div class="alert alert-danger" role="alert">Mail error. Not to worry though, you are registered</div>';
	//         	header("location: status.php");
	// 				} else {
	// 					$_SESSION['id'] = $conn->insert_id;
	// 					$_SESSION['firstname'] = $firstname;
	// 	      	$_SESSION['surname'] = $lastname;
	// 				  $_SESSION['name'] = strtoupper($firstname);
	// 				  $conn->close();
	// 	  			header("location: profile.php");
	// 	  			exit();
	// 				}
	// 			}

	// 	    else {
	//         $_SESSION['error'] = '<div class="alert alert-danger" role="alert">User with this email already exists</div>';
	//         header("location: status.php");
	//         exit();
	// 	    }

	// 		}

	// 	}

	// }

?>