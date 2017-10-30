<?php
include_once("db.php");
include_once("formatter.php");

class PersonDAOFactory
{ 
	public static function GetDB($name)
    {
		$res = null;
        switch($name) {
			case "mysql":
				$res = new MySqlDB();
				break;
			case "mock":
				$res = new MockDB();
				break;
		}
		return $res;
    }
}

class FormatterFactory {
	public static function GetFormatter($name)
    {
		$res = null;
        switch($name) {
			case "json":
				$res = new JsonFormatter();
				break;
			case "xml":
				$res = new XmlFormatter();
				break;
            case "yaml":
                $res = new YamlFormatter();
                break;
		}
		return $res;
    }
}
?>