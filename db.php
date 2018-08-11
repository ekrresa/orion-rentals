<?php
	/* Database connection settings */

	mysqli_report(MYSQLI_REPORT_STRICT);

	$host = 'db4free.net';
	$username = 'chuck_huey';
	$password = 'KyIkzt9mJRsFNkEq';
	$dbname = "orion_accounts";

	try {
		$conn = new mysqli($host, $username, $password,$dbname);
	}
	catch (mysqli_sql_exception $e) {
		$error = $e->getMessage();
		echo $error;
	}

?>

