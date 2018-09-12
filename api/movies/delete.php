<?php

include_once 'models/Movie.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

$title = $_GET['delete'];

if ($movie->deleteMovie($title)) {
	header("location: movie.php");
  exit();
}
else {
	$_SESSION['error'] = "Unable to delete '$title'";
	header("location: status.php");
  exit();
}