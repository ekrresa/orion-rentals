<?php

	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

		// *************SERVER VALIDATION***************
	if (isset($_POST["upload"])) {

		include 'db.php'; //Database connection

	   $title = $conn->escape_string(test_input($_POST["title"]));
	   $genre = $conn->escape_string(test_input($_POST["genre"]));
	   $year = $conn->escape_string(test_input($_POST["year"]));


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