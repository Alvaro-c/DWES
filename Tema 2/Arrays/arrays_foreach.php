<?php 
/* foreach: función que solo está definia para vectores y objetos
https://www.php.net/manual/es/control-structures.foreach.php
Dos tipos de sintáxis:
	foreach (expresión_array as $valor)
   		sentencias
	foreach (expresión_array as $clave => $valor)
    	sentencias
*/
	$arr2 = array (
		"1111A" => "Juan Vera Ochoa",
		"1112A" => "Maria Mesa Cabeza",
		"1113A" => "Ana Puertas Peral"
	);
	echo "Mostramos solo el valor de cada elemento: ";
	foreach ($arr2 as $nombre) {
		echo "$nombre <br>";		
	}
	echo "Mostramos tanto la clave como el valor de cada elemento: <br>";
	foreach ($arr2 as $codigo => $nombre) {
		echo "Código: $codigo - Nombre: $nombre <br>";		
	}