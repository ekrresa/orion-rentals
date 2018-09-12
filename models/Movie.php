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

  	$query = "SELECT * FROM " .$this->table_name. " WHERE user_id= :id";
  	$stmt = $this->conn->prepare($query);
  	$stmt->bindParam(':id', $id);

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

  public function editMovie($title, $genre, $year) {

  	$user_id = $_SESSION['id'];
  	$pre_title = $_SESSION['pre_title'];

		date_default_timezone_set("Africa/Lagos");
		$upload_date = date("Y-m-d");

  	$query = "UPDATE " .$this->table_name. " SET title= :title, genre= :genre, year= :year, upload_date= :upload_date WHERE id= :user_id AND title= :pre_title";

  	$stmt = $this->conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':upload_date', $upload_date);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':pre_title', $pre_title);

    try {
      $stmt->execute();
      return true;
    }
    catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
      $this->conn = null;
      return false;
    }
  }

  public function deleteMovie($title) {
  	$user_id = $_SESSION['id'];

  	$query = "DELETE FROM " .$this->table_name. " WHERE user_id= :id AND title= :title";
  	$stmt = $this->conn->prepare($query);
  	$stmt->bindParam(':id', $user_id);
  	$stmt->bindParam(':title', $title);

  	if ($stmt->execute()) {
  		return true;
  	} else {
  		return false;
  	}

  }

}