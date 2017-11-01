<?php

interface IPersonDAO
{
    public function create($person);
    public function read();
	public function update($person);
	public function del($person);
	public function addPhoneNumber($person, $number);
}

class MySqlDB implements IPersonDAO
{
	private $username = "root";
	private $password = "";
	private $hostname = "localhost"; 
	private $dbname = "persons";
	private $conn;
	
	function __construct() {
		$this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname) or die("Unable to connect to MySQL");
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		} 
	}

    public function create($person){
		$sql = "INSERT INTO persons VALUES (NULL, '".$person->fn."','".$person->ln."','".$person->age."')";
		$this->conn->query($sql);
	}
	
    public function read(){
		$sql = "SELECT * FROM persons";
		$result = $this->conn->query($sql);
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$sql = "SELECT phone_number FROM phone_numbers WHERE person_id=".$r['id'];
			$resultNumbersQuery = $this->conn->query($sql);
			$numbers = array();
			while($num_row = mysqli_fetch_assoc($resultNumbersQuery)) {
				array_push($numbers, $num_row['phone_number']);
			}
			
			$r["numbers"] = $numbers;
			$rows[] = $r;
		}
		return $rows;
	}
	
	public function update($person){
		$sql = "UPDATE `persons` SET `fn`='".$person->fn."',`ln`='".$person->ln."',`age`=".$person->age." WHERE `id` = ".$person->id;
		$this->conn->query($sql);
	}
	
	public function del($person){
		$sql = "DELETE FROM `persons` WHERE `id` = ".$person->id;
		$this->conn->query($sql);
	}
	
	public function addPhoneNumber($person, $number) {
		$sql = "INSERT INTO phone_numbers VALUES (NULL, '".$person."','".$number."')";
		$result = $this->conn->query($sql);
	}	
}

class MockDB implements IPersonDAO
{
	private $persons;
	
	function __construct() {
		$this->persons = array();
		//array_push($this->persons, new Person(1,"Petr","Ivan",42, array()));
	}

    public function create($person){
		array_push($this->persons, $person);
	}
	
    public function read(){
		return $this->persons;
	}
	
	public function update($person){
		$this->persons[$person->id] = $person;
	}
	
	public function del($person){
		$this->persons = array_diff($this->persons, $person);
	}
	
	public function addPhoneNumber($person, $number) {
        array_push($this->persons[$person->id]->numbers, $number);
	}	
}

?>