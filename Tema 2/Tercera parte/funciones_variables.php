<?php
	$var1 = 4;
	$var2 = NULL;
	$var3 = FALSE;
	$var4 = 0;
	echo " var 1 = 4 <br>· ¿inicializada? ";
	var_dump(isset($var1));    // TRUE
	echo " <br>· ¿es nula? ";
	var_dump(is_null($var1));  // FALSE
	echo " <br>· ¿es falso o vacia? ";
	var_dump(empty($var1));    // FALSE
	echo "<br> var 2 = NULL <br>· ¿inicializada? ";
	var_dump(isset($var2));	   // FALSE
	echo " <br>· ¿es nula? ";
	var_dump(is_null($var2));  // TRUE
	echo " <br>· ¿es falso o vacia? ";
	var_dump(empty($var2));    // TRUE
	echo "<br> var 3 = FALSE <br>· ¿inicializada? ";
	var_dump(isset($var3));    // TRUE
	echo " <br>· ¿es nula? ";
	var_dump(is_null($var3));  // FALSE
	echo " <br>· ¿ss falso o vacia? ";
	var_dump(empty($var3));    // TRUE
	echo "<br> var 4 empty <br>· ¿es falso o vacia? ";
	var_dump(empty($var4));    // TRUE, EL 0 COMO BOOLEAN ES FALSE
	echo "<br> var 1 unset <br>· ¿Inicializada? ";
	unset($var1);
	var_dump(isset($var1));	   // FALSE