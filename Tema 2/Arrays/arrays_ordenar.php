<?php
/* El listado completo de ordenamientos se encuentra en
https://www.php.net/manual/es/array.sorting.php
asort(): Ordena por valor, mateniendo las claves
sort(): Ordena por valor, borrando las claves
*/
	$arr1 = [
		0 => 444,
		1 => 222,
		2 => 333,
	];
	$arr2 = array (
		"1111A" => "Juan Vera Ochoa",
		"1112A" => "Maria Mesa Cabeza",
		"1113A" => "Ana Puertas Peral"
	);
    $arr3 = $arr2;
    asort($arr1); // Ordenar los valores conservando las claves. Ordena según ASCII
    print_r($arr1);
    print "<br>";
    asort($arr2); // Ordena los valores consevando las claves. Ordena según ASCII
    print_r($arr2);
    print "<br>";
    sort($arr3); // ordena por valores, borra las claves y asigna claves como 0, 1, 2, 3
    print_r($arr3);    