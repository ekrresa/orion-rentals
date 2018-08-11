<?php
	/* Database connection settings */

	mysqli_report(MYSQLI_REPORT_STRICT);

	$host = "localhost";
	$username = "root";
	$password = "KyIkzt9mJRsFNkEq";
	$dbname = "localdb";

	try {
		$conn = new mysqli($host, $username, $password,$dbname);
	}
	catch (mysqli_sql_exception $e) {
		$error = $e->getMessage();
		echo $error;
	}

?>

