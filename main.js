function factory(format, param) {
	var reader;
	if (format == 'json') {
		reader = new JsonReader(param);
	} else if (format == 'xml') {
		reader = new XmlReader(param);
	} else if (format == 'html') {
		reader = new HtmlReader(param);
	}
	return reader;
}

function create() {
	var fn = document.getElementById('fn').value;
	var ln = document.getElementById('ln').value;
	var age = document.getElementById('age').value;
	
	var dbSelector = document.getElementById("db");
	var db = dbSelector.options[dbSelector.selectedIndex].value;

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "index.php?method=create&fn="+fn+"&ln="+ln+"&age="+age+"&db="+db, false);
	xmlhttp.send();
}

function read() {
	var formatSelector = document.getElementById("format");
	var format = formatSelector.options[formatSelector.selectedIndex].value;
	
	var dbSelector = document.getElementById("db");
	var db = dbSelector.options[dbSelector.selectedIndex].value;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "index.php?method=read&format=" + format + "&db=" + db, false);
	xmlhttp.send();
	
	console.log(format);

	console.log(xmlhttp.responseText);
	var reader = factory(format, xmlhttp.responseText);
	
	var table = document.getElementById('tbody');
	table.innerHTML = reader.responce.innerHTML;
}

function update() {
	var id = document.getElementById('id').value;
	var fn = document.getElementById('fn').value;
	var ln = document.getElementById('ln').value;
	var age = document.getElementById('age').value;
	
	var dbSelector = document.getElementById("db");
	var db = dbSelector.options[dbSelector.selectedIndex].value;

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "index.php?method=update&id="+id+"&fn="+fn+"&ln="+ln+"&age="+age+"&db="+db, false);
	xmlhttp.send();
}

function del() {
	var id = document.getElementById('id').value;
	
	var dbSelector = document.getElementById("db");
	var db = dbSelector.options[dbSelector.selectedIndex].value;

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "index.php?method=delete&id="+id+"&db="+db, false);
	xmlhttp.send();
}

function addPhone() {
	var id = document.getElementById('id_person');
	var num = document.getElementById('num');
	
	var dbSelector = document.getElementById("db");
	var db = dbSelector.options[dbSelector.selectedIndex].value;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "index.php?method=add_phone&person_id="+id.value+"&phone_number="+num.value+"&db="+db, false);
	xmlhttp.send();
}