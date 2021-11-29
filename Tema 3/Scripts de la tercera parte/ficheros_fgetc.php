<?php
	$fich = fopen("fichero_ejemplo.txt", "r");
	if ($fich === False){
		echo "No se encuentra el fichero o no se pudo leer<br>";
	}else{
		while( !feof($fich) ){
			$car = fgetc($fich);			
			echo $car. "<br>";
		}
	}
	fclose($fich); 