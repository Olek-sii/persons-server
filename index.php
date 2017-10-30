<?php
	include_once("factory.php");
	include_once("person.php");

	if ($_GET['method'] == 'create')
	{
		$fn = $_GET['fn'];
		$ln = $_GET['ln'];
		$age = $_GET['age'];
		
		$db = $_GET['db'];
		$connection = PersonDAOFactory::GetDB($db);		
		$connection->create(new Person(0, $fn, $ln, $age));
	}

	if ($_GET['method'] == 'read')
	{
		$db = $_GET['db'];
		$format = $_GET['format'];
		
		$connection = PersonDAOFactory::GetDB($db);
		$formatter = FormatterFactory::GetFormatter($format);
		
		$rows = $connection->read();
		echo $formatter->format($rows);
	}

	if ($_GET['method'] == 'update')
	{
		$id = $_GET['id'];
		$fn = $_GET['fn'];
		$ln = $_GET['ln'];
		$age = $_GET['age'];
		
		$db = $_GET['db'];
		$connection = PersonDAOFactory::GetDB($db);		
		$connection->update(new Person($id, $fn, $ln, $age));
	}

	if ($_GET['method'] == 'delete')
	{
		$id = $_GET['id'];
		
		$db = $_GET['db'];
		$connection = PersonDAOFactory::GetDB($db);		
		$connection->del(new Person($id, "","",0));
	}
	
	if ($_GET['method'] == 'add_phone')
	{
		$db = $_GET['db'];
		$connection = PersonDAOFactory::GetDB($db);
		$connection->addPhoneNumber($_GET['person_id'], $_GET['phone_number']);
	}
?>