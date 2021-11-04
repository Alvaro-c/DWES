<?php	
	function calculador($operacion, $numa, $numb){		
		$resul = $operacion($numa, $numb);
		return $resul;
	}
	function sumar($a, $b){
		return $a + $b;
	}
	function multiplicar($a, $b){
		return $a * $b;
	}
	$a = 4;
	$b = 5;
	$r1 = calculador("multiplicar", $a, $b);
	echo "$r1 <br>";
	$r2 = calculador("sumar", $a, $b);
	echo "$r2 <br>";