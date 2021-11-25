<?php	
	function manejadorErrores($errno, $str, $file, $line){
		/* Originalmente mostrabamos toda esta información, ahora la guardamos en un registro.
		echo "Ocurrió el error: $errno <br>";
		echo "Nombre del error: $str <br>";
		echo "Archivo del error: $file <br>";
		echo "Línea del error: $line <br>";
		*/
		$log = fopen('error.log','a');
		fwrite($log, "[".date("r")."]. Error $errno, línea $line, archivo $file: $str\n");
		fclose($log);
	}
	set_error_handler("manejadorErrores");
	$a=3;
	$a = $b; // causa error, $b no está inicializada