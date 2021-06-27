<?php

$url = "https://tfgbd-7eb0.restdb.io/rest/estadistiques";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','x-apikey: a797522efb0f9291cdf8f52c3ba6e3e79b047') );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$return_data = curl_exec($ch);
curl_close($ch);
//header("Refresh:10");
$json = json_decode($return_data, true);
foreach ($json as $key => $value) {
	echo "NIU: ";
	echo $value["niu"] . "<br>";
	echo "Puntuació: ";
	echo $value["puntuacio"] . "<br>";
	echo "Encerts: ";
	echo $value["encerts"] . "<br>";
	echo "Errors: ";
	echo $value["errors"] . "<br><br>";
	}
								


$arr_clientes = array('nombre'=> 'Jose', 'edad'=> '20', 'genero'=> 'masculino',
        'email'=> 'correodejose@dominio.com', 'localidad'=> 'Madrid', 'telefono'=> '91000000');


//Creamos el JSON
$json_string = json_encode($json);
$file = 'estadistiques.json';
file_put_contents($file, $json_string);


//Creamos el JSON
//$json_string = json_encode($arr_clientes);
//$file = 'clientes.json';
//file_put_contents($file, $json_string);


?>
<!DOCTYPE HTML>
<html>
<head>
<script>

window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Daily Sales Data"
	},
	axisY: {
		title: "Units",
		titleFontSize: 24,
		includeZero: true
	},
	data: [{
		type: "column",
		yValueFormatString: "#,### Units",
		dataPoints: dataPoints
	}]
});



function addData(data) {
	
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			x: data[i].encerts,
			y: data[i].errors
		});
	}
	chart.render();

}

$.getJSON('estadistiques.json', addData);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>