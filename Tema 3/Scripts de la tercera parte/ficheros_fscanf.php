<?php
	$fich = fopen("matriz.txt", "r");
	if ($fich === False){
		echo "No se encuentra el fichero o no se pudo leer<br>";
	}else{
		while( !feof($fich) ){
			$num = fscanf($fich, "%d %d %d %d");
			echo "$num[0] $num[1] $num[2] $num[3] <br>";
		}
	}
	rewind($fich);
	while( !feof($fich) ){
			$num = fscanf($fich, "%d %d %d %d", $num1, $num2, $num3, $num4 );
			echo "$num1 $num2 $num3 $num4 <br>";
		}
	fclose($fich);