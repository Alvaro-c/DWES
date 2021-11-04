<?php
	$arr1 = array(
		1 => "3000",
		2 => "4000",
	);
	$arr2 = array(
		1 => 3000,
		2 => 4000,
	);
	$arr3 = array(
		2 => "4000",
		1 => "3000",
	);

	// 1 y 3 no son idénticos porque aunque tenga mismas claves y valores, la posición es la misma
	// == y === se comparan como con el resto de comparaciones.
	if($arr1 == $arr2){
		echo "arr1 y arr2 son iguales <br>";
	}else{
		echo "arr1 y arr2 no son iguales <br>";
	}
	if($arr1 == $arr3){
		echo "arr1 y arr3 son iguales <br>";
	}else{
		echo "arr1 y arr3 no son iguales <br>";
	}
	if($arr1 === $arr2){
		echo "arr1 y arr2 son idénticos <br>";
	}else{
		echo "arr1 y arr2 no son idénticos <br>";
	}
	if($arr1 === $arr3){
		echo "arr1 y arr3 son idénticos <br>";
	}else{
		echo "arr1 y arr3 no son idénticos <br>";
	}