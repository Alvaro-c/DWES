<?php	
	function manejadorErrores($errno, $str, $file, $line){
		echo "Ocurrió el error: $errno <br>";
		echo "Nombre del error: $str <br>";
		echo "Archivo del error: $file <br>";
		echo "Línea del error: $line <br>";
	}
	set_error_handler("manejadorErrores");
	$a=3;
	$a = $b; // causa error, $b no está inicializada