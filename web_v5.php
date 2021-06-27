<!doctype html>
<html>
	<head>
		<title>Estadístiques</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-hQpvDQiCJaD2H465dQfA717v7lu5qHWtDbWNPvaTJ0ID5xnPUlVXnKzq7b8YUkbN" crossorigin="anonymous">
		<link href="https://tfgbd-7eb0.restdb.io/assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
		<style>
			
			#panel_menu{
			  padding: 50px;
			}

			#panel_bd{
			  padding: 10px;
			}
			
			#info_cos{
				padding: 20px;
			}

			pre {
				display: block;
				padding: 9.5px;
				margin: 0 30px 10px;
				font-size: 13px;
				line-height: 1.42857143;
				color: #000000;
				word-break: break-all;
				word-wrap: break-word;
				background-color: #FFFFFF;
				border: 0px solid #ccc;
				border-radius: 0px;
			}
		</style>

</head>

<body>
	<div class="col-sm-12">
				<div class="lead center-block"> </div>
			</div>
			<div class="col-sm-12" id="panel_menu">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><b>Puntuacions Globals</b></h3>
					</div>
					 <div class="panel-body" id="panel_bd">
						<div class="ct-line ct-golden-section" id="traffic_chart"></div>
					
					<div id="info_cos">
					
					<?php   
					
						
						class RestDb {

						public function selectDocument() {
							$url = "https://tfgbd-7eb0.restdb.io/rest/estadistiques";
							$ch = curl_init($url);
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','x-apikey: a797522efb0f9291cdf8f52c3ba6e3e79b047') );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
							$return_data = curl_exec($ch);
							curl_close($ch);
							header("Refresh:10");
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
								
					
							}
						}
						$bd = new RestDb;
						$results = $bd->selectDocument();
						//print "<pre>";
						//print_r($results);
						//print "</pre>"

					
					?>
					</div>
				</div>
					
				</div>
			</div>
	</div>
	
</body>
</html>