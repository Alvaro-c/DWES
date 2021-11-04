<?php
	echo PHP_INT_SIZE.'<br>';
	echo PHP_INT_MIN.'<br>';
	echo PHP_INT_MAX.'<br>';
	$a = 3/2;   // la división entre enteros no da problemas
	echo $a.'<br>';	// 1.5	(además el punto sirve para concatenar)
	$b = 7.5;
	$a = (int) $b; // cambias a entero a int
	echo $a.'<br>';	// 7, se trunca		
	$b = 7e2; // notación científica
	echo $b.'<br>';
	$b = 7E2; // no es sensible a mayúsculas y minúsculas
	echo $b.'<br>';
	$b = 0.1E-2; // numeros real en notación exponencial
	echo $b.'<br>';
    $b = 0.001; // el mismo número real en notación decimal
	echo $b.'<br>';
	$a = 0.99999999999999999;
	echo floor($a). '<br>'; // devuelve 1
	$a = 0.9999999999999999;
	echo floor($a); // devuelve 0