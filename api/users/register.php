<?php
	use PHPMailer\PHPMailer\PHPMailer;

	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

		// *************SERVER VALIDATION***************
	if (isset($_POST["signup"])) {

		// require 'vendor/autoload.php';
		include_once 'models/User.php';

		// get database connection
		$database = new Database();
		$db = $database->getConnection();

		// prepare user object
		$user = new User($db);

    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $email = test_input($_POST["email"]);
    $password = password_hash(test_input($_POST['password']), PASSWORD_BCRYPT);

  	// Check if user with that email already exists
		$result = $user->registerUser($firstname, $lastname, $email, $password);

		if ($result) {
		  header("location: profile.php");
	  	exit();
		}
		else {
      header("location: status.php");
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