<?php
	$datos = simplexml_load_file("prueba.xml");
	if($datos===false){
		echo "Error al leer el fichero";
	}
	echo "<pre>";
	foreach($datos as $valor){
		
		print_r($valor);
		echo "<br>";
	}
	echo "</pre>";