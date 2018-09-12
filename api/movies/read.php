<?php

include_once 'models/Movie.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$movie = new Movie($db);

$user_id = $_SESSION['id'];

if ($movie->getMovies($user_id) == false) {
	$_SESSION['error'] = "Unable to get movies from database";
	header("location: status.php");
  exit();
}
else {
	$result = $movie->getMovies($user_id);
	$num = $result->rowCount();
}
