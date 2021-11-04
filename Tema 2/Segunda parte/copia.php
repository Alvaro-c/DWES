<?php
	$var1 = 100; 
	$var2 = &$var1;  // asignación por referencia
	$var3 = $var1;   // asignación por copia
	echo "$var2<br>";// muestra 100
	$var2 = 300;     // cambia el valor de $var2
	echo "$var1<br>";// $var1 también cambia
	$var3 = 400;     // este cambio no afecta a $var1
	echo "$var1<br>";
	echo $var3;
