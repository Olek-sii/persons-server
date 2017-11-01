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
		$res = '<persons>';
        foreach ($obj as $person) {
        	$res .= '<person>';
			$res .= '<id>' . $person->id . '</id>';
            $res .= '<fn>' . $person->fn . '</fn>';
            $res .= '<ln>' . $person->ln . '</ln>';
            $res .= '<age>' . $person->age . '</age>';
            $res .= '</person>';
		}
		$res .= '</persons>';
		return $res;
	}
}

class YamlFormatter implements IFormatter {
    public function format($obj) {
        $echo = "Persons:";
        for ($i = 0 ; $i < count($obj) ; ++$i)
        {
            $echo .=  "\n- Id: ".$obj[$i]->id;
            $echo .=  "\n\tFirstName: ".$obj[$i]->fn;
            $echo .=  "\n\tLastName: ".$obj[$i]->ln;
            $echo .=  "\n\tAge: ".$obj[$i]->age;
        }
        return $echo;
    }
}
?>

