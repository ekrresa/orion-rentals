<?php

class Database {

	private $host = 'localhost';
	private $username = 'root';
	private $password = 'KyIkzt9mJRsFNkEq';
	private $dbname = "orion_db";
	private $conn;

	public function getConnection() {

		try {
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $exception){
      echo "Connection error: " . $exception->getMessage();
    }

		return $this->conn;
	}
}

?>

