<?php

	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

		// *************SERVER VALIDATION***************
	if (isset($_POST["create"])) {

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

			$id = $_SESSION['id'];

			date_default_timezone_set("Africa/Lagos");
			$create_date = date("Y-m-d H:i:s");


	    $sql = "INSERT INTO `profiles`(user_id, firstname, lastname, phone, address, city, state, created_at) ". "VALUES ('$id', '$firstname','$lastname','$phone','$address', '$city', '$state', '$create_date')";


	    if ( $conn->query($sql) ){

			  $_SESSION['success'] = '<div class="alert alert-success" role="alert">Profile created successfully.</div>';
			  $conn->close();
				header("location: status.php");
				exit();
			}

	    else {
	      $_SESSION['error'] = '<div class="alert alert-danger" role="alert">'.$conn->error.'</div>';
	      $conn->close();
	      header("location: status.php");
	      exit();
	    }

		}

	}

?>