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

		include_once 'models/Profile.php';

		// get database connection
		$database = new Database();
		$db = $database->getConnection();

		// prepare user object
		$profile = new Profile($db);

		// User Details
		$firstname = test_input($_POST["firstname"]);
		$lastname = test_input($_POST["lastname"]);
		$phone = test_input($_POST["phone"]);
		$address = test_input($_POST["address"]);
		$city = test_input($_POST["city"]);
		$state = test_input($_POST["state"]);

		$user_id = $_SESSION['id'];

    if ($profile->createProfile($firstname, $lastname, $phone, $address, $city, $state)){
			header("location: status.php");
			exit();
		}
		else {
      header("location: status.php");
      exit();
    }

	}

?>