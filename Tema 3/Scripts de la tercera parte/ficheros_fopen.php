<?php
	$fich = fopen("fichero_ejemplo.txt", "r");
	if ($fich === False){
		echo "No se encuentra fichero_ejemplo.txt<br>";
	}else{
		echo "fichero_ejemplo.txt se abrió con éxito<br>";
	}
	$fich = fopen("fichero_no_existe.txt", "r");
	if ($fich === False){
		echo "No se encuentra fichero_no_existe.txt<br>";
	}else{
		echo " fichero_no_existe.txt se abrió con éxito<br>";
	}
	//fclose($fich); 