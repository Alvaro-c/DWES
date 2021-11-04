<?php
	//Array escalar
	$arr1 = [
		0 => 444,
		1 => 222,
		2 => 333,
	];
	print "Array escalar: <br>";
	print_r($arr1);
	echo "<br>" . "pos 0: " . $arr1[0] . "<br>";
	$arr1[0] = 555;
	print "Modifico el elemento con clave '0'";
	print_r($arr1);
	echo "<br>";
	//Array asociativo
	$arr2 = array (
		"1111A" => "Juan Vera Ochoa",
		"1112A" => "Maria Mesa Cabeza",
		"1113A" => "Ana Puertas Peral"
	);
	print "Array asociativo: <br>";
	print_r($arr2);
	echo "<br> Modifico el elemento con la clave 1113A: <br>";
	$arr2["1113A"] = "Ana Puertas Segundo";
	print_r($arr2);
	echo "<br>";
	//Array clave repetida
	$arr3 = [
		0 => "aaa",
		"a" => 222,
		2 => "bbb",
		0 => Null,
	];
	print "Array con la clave '0' repetida <br>";
	print_r($arr3);
