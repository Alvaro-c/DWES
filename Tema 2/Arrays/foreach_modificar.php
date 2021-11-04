<?php
/* Recordemos la sintaxis para las funciones.
function nombre(argumentos){
	sentencias1
	sentenciasN
}
Ejemplo:
function suma($a, $b){
	return $a+$b;
}
*/
	$arr1 = array(
		"Viernes" => 22,
		"Sábado" => 34
	);
	echo "Array originalmente definido: <br>";
	print_r($arr1);
	echo "<br>";
	/* no modifica el array */
	foreach ($arr1 as $cantidad) {
		$cantidad = $cantidad * 2;		
	}
	echo "El array NO se modifica si pasamos el valor por copia: <br>";
	print_r($arr1);
	echo "<br>";
	/* modifica el array */
	foreach ($arr1 as &$cantidad) {
		$cantidad = $cantidad * 2;			
	}	
	echo "El array SI se modifica si pasamos el valor por referencia: <br>";
	print_r($arr1);