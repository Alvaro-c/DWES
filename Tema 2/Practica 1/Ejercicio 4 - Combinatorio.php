<?php

include 'Ejercicio 4 - Factorial.inc.php';

$m = 3;
$n = 5;


function combinatorio($m, $n)
{

    if ($n < $m || $n <= 0) {

        echo ("El número combinatorio C($m, $n) no existe.");
    } else {

        $resultado = factorial($n) / (factorial($m) * factorial($n - $m));

        echo ("El número combinatorio C($m, $n) vale $resultado");
    }
}


combinatorio($m, $n);
