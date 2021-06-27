<?php
// Obtenim les dades de la BD
$url = "https://tfgbd-7eb0.restdb.io/rest/estadistiques";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','x-apikey: a797522efb0f9291cdf8f52c3ba6e3e79b047') );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$return_data = curl_exec($ch);
curl_close($ch);
header("Refresh:5");
$json = json_decode($return_data, true);
echo "<br><br> ";
foreach ($json as $key => $value) {
	 "NIU: ";
	 $value["niu"] . "<br>";
	 "Puntuació: ";
	 $value["puntuacio"] . "<br>";
	 "Encerts: ";
	 $value["encerts"] . "<br>";
	 "Errors: ";
	 $value["errors"] . "<br><br>";
	}
			


//Arxiu JSON amb les estadistiques
$json_string = json_encode($json);
$file = 'estadistiques.json';
file_put_contents($file, $json_string);


?>
<!DOCTYPE HTML>
<html>
<head>
<script>

window.onload = function() {
CanvasJS.addColorSet("color_grafiques",
                [//colorSet Array (verd, vermell )

                "#2E8B57",
                "#E64840"                
                ]);
var dataErrors = [];
var dataEncerts = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	//theme: "light1",
	 colorSet: "color_grafiques",
	title: {
		text: "Estadístiques"
	},
	axisX:{
		title: "NIU",
		reversed: true
	},
	axisY:{
		title: "Encerts / Errors",
		includeZero: true
	},
	toolTip:{
		shared: true
	},
	data: [{
		type: "stackedBar",
		name: "Encerts",
		dataPoints: dataEncerts
	},{
		type: "stackedBar",
		name: "Errors",
		dataPoints: dataErrors
	}]
});



function addData(data) {
	
	for (var i = 0; i < data.length; i++) {
		dataErrors.push({
			label: data[i].niu,
			y: data[i].errors
		});
		
		dataEncerts.push({
			label: data[i].niu,
			y: data[i].encerts
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