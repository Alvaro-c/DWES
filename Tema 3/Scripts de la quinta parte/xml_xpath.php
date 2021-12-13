<?php
	$datos = simplexml_load_file("empleados.xml");	
	$edades = $datos->xpath("//edad");
	foreach($edades as $valor){
		print_r($valor);
		echo "<br>";
	}