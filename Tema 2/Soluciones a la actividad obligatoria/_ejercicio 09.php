<?php
function capicua($numero)
{
/* Podemos utilizar la función strrev() al igual que con los palíndroms sin forzar la conversión del número a string
$numero = (string) $numero;
*/
    if ($numero == strrev($numero)) {
        echo "$numero <br>";
    }
}

for ($i = 1; $i <= 99999; $i++){
    capicua($i);
}