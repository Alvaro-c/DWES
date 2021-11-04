<?php
	$arr1 = array(
		10 => "3000",
		20 => "4000",
		30 => "6000",
	);
	print_r($arr1);
	echo "<br>";
	$arr2 = array(
		10 => "8000",
		15 => "6000",
		20 => "4000",
	);
	print_r($arr2);
	echo "<br>";
	$arr3 = $arr1 + $arr2;
	print_r($arr3);