<?php

interface IFormatter
{
    public function format($obj);
}

class JsonFormatter implements IFormatter {
	public function format($obj) {
		return json_encode($obj);
	}
}

class XmlFormatter implements IFormatter {
	public function format($obj) {
		$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><persons></persons>");
		$this->array_to_xml($obj, $xml_user_info);
		return $xml_user_info->asXML();
	}
	
	function array_to_xml($array, &$xml_user_info) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				if(is_numeric($key)){
					$subnode = $xml_user_info->addChild("item$key");
					$this->array_to_xml($value, $subnode);
				}else{
					$subnode = $xml_user_info->addChild("$key");
					$this->array_to_xml($value, $subnode);
				}
			}else {
				if(is_numeric($key)){
					$xml_user_info->addChild("item$key",htmlspecialchars("$value"));
				}else{
					$xml_user_info->addChild("$key",htmlspecialchars("$value"));
				}
			}
		}
	}
}

class YamlFormatter implements IFormatter {
    public function format($obj) {
        return yaml_emit($obj);
    }
}
?>

