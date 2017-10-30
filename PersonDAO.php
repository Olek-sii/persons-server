<?php
	include_once 'factory.php';

	interface IPersonDAO {
		function  create($person);
		function read($format);
		function update($person);
		function delete($person);
	}

	class MySql implements IPersonDAO
	{
		private $username = "root";
		private $password = "";
		private $hostname = "localhost"; 
		private $dbname = "persons";
		private $conn = null;

		function __construct() {
			$this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname) or die("Unable to connect to MySQL");
			if ($this->conn->connect_error) {
				die("Connection failed: " . $this->conn->connect_error);
			} 
		}

		function create($person) {
			$sql = "INSERT INTO persons VALUES (NULL, '".$person->fn."','".$person->ln."','".$person->age."')";
			$result = $this->conn->query($sql);
		}

		function read($format) {
			$sql = "SELECT * FROM persons";
			$result = $this->conn->query($sql);
			$rows = array();
			while($r = mysqli_fetch_assoc($result)) {
				$rows[] = $r;
			}

			$converter = ConverterFactory::getConverter($format);
			return $converter->convert($rows);
		}

		function update($person) {
			$sql = "UPDATE `persons` SET `fn`='".$person->fn."',`ln`='".$person->ln."',`age`=".$person->age." WHERE `id` = ".$person->id;
			$result = $this->conn->query($sql);
		}

		function delete($person) {
			$sql = "DELETE FROM `persons` WHERE `id` = ".$person->id;
			$result = $this->conn->query($sql);
		}
	}
?>