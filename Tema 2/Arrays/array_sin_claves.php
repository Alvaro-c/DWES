<?php
	$arr1 = array(10, 20, 30, 40); 
	print_r($arr1);
	echo "<br>";
	echo "Añadimos un elemento más sin especificar la clave: <br>";
	$arr1[] = 5;
	print_r($arr1);
	echo "<br>";
	echo "Añadimos varios elementos con claves no consecutivas: <br>";
	$arr1[12] = 6; 
	$arr1[11] = 5;
    $arr1[] = 5;
	print_r($arr1);	
	echo "<br>";