<?php

require_once 'config/Database.php';

class User{

    // database connection, table name and error
    private $conn;
    private $table_name = "users";

    // constructor with $db as database connection
    public function __construct($db){
      $this->conn = $db;
    }

    // Check If User Exists
    private function userExists($email) {

      $query = "SELECT COUNT(*) FROM " .$this->table_name. " WHERE email =:email LIMIT 1";

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      if ($stmt) {
        $row_count = $stmt->fetchColumn();

        if ($row_count == 0){
          return false;
        }
        else {
          return true;
        }
      }
      else {
        $_SESSION['error'] = "unable to execute query";
        return;
      }

    }

    // Register Account
    public function registerUser($firstname, $lastname, $email, $password) {

      if ($this->userExists($email) == true) {
        $_SESSION['error'] = "user with this email has been registered";
        return;
      }
      else {
        date_default_timezone_set("Africa/Lagos");
        $regdate = date("Y-m-d H:i:s");

        $query = "INSERT INTO " .$this->table_name. " (firstname, lastname, email, password, reg_date) "
        . "VALUES (:firstname, :lastname, :email, :password, :regdate)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':regdate', $regdate);

        try {
          $stmt->execute();
          $_SESSION['id'] = $this->conn->lastInsertId();
          $_SESSION['firstname'] = $firstname;
          $_SESSION['surname'] = $lastname;
          $_SESSION['name'] = strtoupper($firstname);
          $this->conn = null;
          return true;
        }
        catch (PDOException $e) {
          $_SESSION['error'] = $e->getMessage();
          $this->conn = null;
          return;
        }

      }
    }

}