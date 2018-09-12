<?php

require_once 'config/Database.php';

class Movie {

	// database connection, table name and error
  private $conn;
  private $table_name = "movies";

  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  public function uploadMovie($title, $genre, $year, $pic_url) {

  	$user_id = $_SESSION['id'];

		date_default_timezone_set("Africa/Lagos");
		$upload_date = date("Y-m-d");

  	$query = "INSERT INTO " .$this->table_name. "(user_id, title, genre, year, pic_url, upload_date) VALUES (:user_id, :title, :genre, :year, :pic_url, :upload_date)";

  	$stmt = $this->conn->prepare($query);
  	$stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':pic_url', $pic_url);
    $stmt->bindParam(':upload_date', $upload_date);

    try {
      $stmt->execute();
      $_SESSION['success'] = 'Movie uploaded successfully';
      $this->conn = null;
      return true;
    }
    catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
      $this->conn = null;
      return false;
    }
  }

  public function getMovies($id) {

  	$query = "SELECT * FROM `movies` WHERE user_id='$id'";
  	$stmt = $this->conn->prepare($query);

  	try {
      $stmt->execute();
      return $stmt;
    }
    catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
      $this->conn = null;
      return false;
    }
  }

}