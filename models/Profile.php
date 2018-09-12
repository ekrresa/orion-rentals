<?php

require_once 'config/Database.php';

class Profile {

	// database connection, table name and error
  private $conn;
  private $table_name = "profiles";

  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  // Create user profile
  public function createProfile($firstname, $lastname, $phone, $address, $city, $state) {

  	$user_id = $_SESSION['id'];

		date_default_timezone_set("Africa/Lagos");
		$create_date = date("Y-m-d H:i:s");

  	$query = "INSERT INTO " .$this->table_name. "(user_id, firstname, lastname, phone, address, city, state, created_at) ". "VALUES (:user_id, :firstname, :lastname, :phone, :address, :city, :state, :create_date)";

  	$stmt = $this->conn->prepare($query);
  	$stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':create_date', $create_date);

    try {
      $stmt->execute();
      $_SESSION['success'] = 'Profile created successfully';
      $this->conn = null;
      return true;
    }
    catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
      $this->conn = null;
      return false;
    }
  }
}