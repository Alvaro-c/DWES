<?php
include("_ejercicio 04.inc.php");
/* --- Calculamos el número combinatorio con las condiciones del enunciado ---*/
function combinatorio($m, $n){
    if (($n < $m) Or ($n <= 0)){
        return "El número combinatorio no existe";
    } else {
        return factorial($n)/(factorial($m)*factorial($n - $m));
    }
}
/* --- Mostramos la salida solicitada ---*/
$m = 3;
$n = 5;
echo "El número combinatorio C($n,$m) es ". combinatorio($m,$n);