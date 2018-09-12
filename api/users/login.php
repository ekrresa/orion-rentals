<?php

if (isset($_POST["login"])) {

	include_once 'models/User.php';

	// get database connection
	$database = new Database();
	$db = $database->getConnection();

	// prepare user object
	$user = new User($db);

	$email = test_input($_POST["email"]);
	$password = $_POST["password"];

	$result = $user->loginUser($email, $password);

	if ($result) {
		header("location: index.php");
		exit();
	}
	else {
		header("location: status.php");
		exit();
	}


}


?>