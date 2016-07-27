<?php

class DBConnection {

		private $DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
		private $DBUser   = 'root';
		private $DBPass   = 'root';
	 	private $DBName   = 'db_name';

	 	// Constructor for DBConnection, creates database if it doesn't exist already and table
		function __construct() {
			$conn = $this->connectDB();

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			$sql = "CREATE DATABASE IF NOT EXISTS $this->DBName";

			    if ($conn->query($sql) === TRUE) {

		        $conn->select_db("$this->DBName");

		        $sql = "CREATE TABLE IF NOT EXISTS movies (
		                  id int(11) NOT NULL AUTO_INCREMENT,
		                  title VARCHAR( 255 )  NOT NULL,
		                  description VARCHAR( 255 )  NOT NULL,
		                  image VARCHAR( 255 )  NOT NULL,
		                  rating_score INT( 11 )  NOT NULL,
		                  rating_submitted INT( 11 )  NOT NULL,
		                  PRIMARY KEY (id)
		                ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8";

		        if ($conn->query($sql) === FALSE) {
		            echo "Error creating table: " . $conn->error;
		        }
		    }

		    else
		    {
		        echo "Error creating database: " . $conn->error;
		    }


		}

		// Connect to database
		function connectDB() {
			$conn = new mysqli($this->DBServer, $this->DBUser, $this->DBPass);
			return $conn;
		}

		// Select Database
		function selectDB($conn) {
			mysqli_select_db($conn,$this->DBName);
		}

		// Count rows
		function numRows($query) {
			$conn = new mysqli($this->DBServer, $this->DBUser, $this->DBPass, $this->DBName);
			$result = $conn->query($query);
			$rowcount = $result->num_rows;
			return $rowcount;
		}

		// Update Query
		function updateQuery($query) {
			$conn = new mysqli($this->DBServer, $this->DBUser, $this->DBPass, $this->DBName);
			$result = $conn->query($query);
			if(!$result) {
				die(die('Invalid query: ' . $conn->connect_error));
			}
			else
			{
				return $result;
			}
		}

		// Run Query
		function runQuery($query) {
		     $conn = new mysqli($this->DBServer, $this->DBUser, $this->DBPass, $this->DBName);
			 if ($result = $conn->query($query))
			 {
				 while($row = $result->fetch_assoc()) {
				    $resultset[] = $row;
				 }

				 return $resultset;

			 }

			 if (!$conn->query($query)) {
		        printf("Error: %s\n", $conn->error);
		    }
		}
}
?>
