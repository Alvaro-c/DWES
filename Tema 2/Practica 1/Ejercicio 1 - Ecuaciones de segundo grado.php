<?php

/*
(-b +- Raiz (b^2 - 4*a*c))/2*a

>= 0: 2 Soluciones
= 0: 1
< 0 : 0 soluciones

Devuelve las soluciones en un array

*/

// Incognitas

$a = 1;
$b = 1;
$c = 1;


if (($b*$b - 4 * $a * $c) > 0) {


    echo "Dos soluciones <br>";
    $solutions = array();
    print_r($solutions);

    $solutions["Solucion 1"] = (-$b + sqrt($b*$b - (4 * $a * $c)))/ 2*$a;
    $solutions["Solucion 2"] = (-$b - sqrt($b*$b - (4 * $a * $c)))/ 2*$a;
    print_r($solutions);

} elseif (($b*$b - 4 * $a * $c) == 0) {

    echo "Una solución: <br>";

    $solutions = (-$b + sqrt($b*$b - 4 * $a * $c))/ 2*$a;
    print_r($solutions);

} else {

    echo "Ninguna solución";
}


