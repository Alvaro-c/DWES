<?php	
	$cat1 = array("cod" => 1, "nombre" => "Comida");
	$cat2 = array("cod" => 2, "nombre" => "Bebida");
	$array = array($cat1, $cat2);
	$json = json_encode($array);	
	echo $json;