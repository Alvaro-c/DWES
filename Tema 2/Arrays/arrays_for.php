<?php
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
    // Recorro el primer array
	echo "Recorro con 'for' un array escalar: <br>";
    for($i=0;$i<3;$i=$i+1){
    	echo "$i => $arr1[$i] <br>";
    }
    // Recorro el segundo array
	echo "Recorro con 'for' un array asociativo: <br>";
    for($i=0;$i<3;$i=$i+1){
    	echo "$i => $arr2[$i] <br>";
    }