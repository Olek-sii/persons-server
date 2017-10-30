<?php
class Person
{
	public $id;
	public $fn;
	public $ln;
	public $age;
	public $numbers;

    function Person($id, $name, $last_name, $age, $numbers) {
        $this->id = $id;
        $this->fn = $name;
        $this->ln = $last_name;
        $this->age = $age;
		$this->numbers = $numbers;
    }
}
?>