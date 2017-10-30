<?php
	interface Converter {
		public function convert($obj);
	}

	class JsonConverter implements Converter
	{
		public function convert($obj)
		{
			return json_encode($obj);
		}
	}

	class XmlConverter implements Converter
	{
		public function convert($obj)
		{
			$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><persons></persons>");
			$this->array_to_xml($obj, $xml_user_info);
			return $xml_user_info->asXML();
		}

		public function array_to_xml($array, &$xml_user_info) {
			foreach($array as $key => $value) {
				if(is_array($value)) {
					if(!is_numeric($key)){
						$subnode = $xml_user_info->addChild("$key");
						$this->array_to_xml($value, $subnode);
					}else{
						$subnode = $xml_user_info->addChild("item$key");
						$this->array_to_xml($value, $subnode);
					}
				}else {
					$xml_user_info->addChild("$key",htmlspecialchars("$value"));
				}
			}
		}
	}

	class HtmlConverter implements Converter
	{
		public function convert($obj)
		{
			$res = "<tbody>";
			foreach ($obj as $key => $value) {
				$res .= '<tr>';
				foreach ($value as $key => $value2) {
					$res .= '<td>' . $value2 . '</td>';
				}
				$res .= '</tr>';
			}
			return $res . '</tbody>';
		}
	}

    class YamlConverter implements Converter
    {
        public function convert($obj)
        {
            $yaml = yaml_emit($obj);
            return $yaml;
        }
    }
?>