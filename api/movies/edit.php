<?php

include_once 'models/Movie.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$movie = new Movie($db);

$user_id = $_SESSION['id'];

if ($movie->editMovie($title, $genre, $year)) {
	$_SESSION['success'] = 'Movie updated successfully';
	header("location: status.php");
  exit();
}
else {
	header("location: status.php");
  exit();
}