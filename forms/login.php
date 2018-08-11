<?php

include 'db.php';

/* User login process, checks if user exists and password is correct */
$errorMsg = "";
$email = "";

if (isset($_POST["login"])) {

	require "db.php";

	// Escape email to protect against SQL injections
	$email = $conn->escape_string($_POST['email']);
	$result = $conn->query("SELECT * FROM users WHERE email='$email'");

	if ( $result->num_rows == 0 ){ // User doesn't exist
	    $errorMsg = "User with that email doesn't exist!";
	    die("error");
	}
	else { // User exists
	    $user = $result->fetch_assoc();

	    if ( password_verify($_POST['password'], $user['password']) ) {

	      $successMsg = "Login was successful";
	    }
	    else {
	      $errorMsg = "You have entered wrong password, try again!";
	    }
	}

}


?>