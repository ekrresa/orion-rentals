<?php

require_once 'config/Database.php';

class User{

    // database connection, table name, user_id and error
    private $conn;
    private $table_name = "users";
    public $error;
    public $user_id;

    //User details
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    // constructor with $db as database connection
    public function __construct($db){
      $this->conn = $db;
    }

    //Clean up data
    private function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // User Registration Function
    public function registerUser() {
      $this->firstname = $this->test_input($this->firstname);
      $this->lastname = $this->test_input($this->lastname);
      $this->email = $this->test_input($this->email);

      if ( $this->userExists() ) {
        $this->error = "user with this email has been registered";
        return;
      }
      else {
        //Encrypt password
        $this->password = password_hash($this->test_input($this->password), PASSWORD_BCRYPT);

        //Get current date
        date_default_timezone_set("Africa/Lagos");
        $regdate = date("Y-m-d H:i:s");

        $query = "INSERT INTO " .$this->table_name. " (firstname, lastname, email, password, reg_date) "
        . "VALUES (:firstname, :lastname, :email, :password, :regdate)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':regdate', $regdate);

        if ($stmt->execute()) {
          $this->user_id = $this->conn->lastInsertId();
          return true;
        } 
        else {
          $this->error = "Error in registering user. Please try again";
          $this->conn = null;
        }
        
        
      }
    }

    // User Login function
    public function loginUser($email, $password) {

      if ($this->checkLogin($email) == false) {
        $_SESSION['error'] = "user is not registered";
        return false;
      } else {
        $user = $this->checkLogin($email);

        if ( password_verify($password, $user->password) ) {

          $_SESSION['name'] = strtoupper($user->firstname);
          $_SESSION['firstname'] = $user->firstname;
          $_SESSION['surname'] = $user->lastname;
          $_SESSION['id'] = $user->id;
          $this->conn = null;
          return true;
        }
        else {
          $_SESSION['error'] = "your password is not correct";
          $this->conn = null;
          return false;
        }
      }

    }

    public function deleteUser() {
      $query = "DELETE FROM ".$this->table_name." WHERE id ='$this->user_id'";
      $this->conn->exec($query);
    }

    // Check If User Exists
    private function userExists() {

      $query = "SELECT COUNT(*) FROM " .$this->table_name. " WHERE email =:email LIMIT 1";

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':email', $this->email);
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

    }

    // Check if email is registered
    private function checkLogin($email) {
      $query = "SELECT id, firstname, lastname, email, password FROM " .$this->table_name. " WHERE email =:email LIMIT 1";

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      if ($stmt) {
        $rows = $stmt->fetch(PDO::FETCH_OBJ);
        return $rows;
      }
      else {
        $_SESSION['error'] = "unable to execute query";
        return;
      }
    }

}