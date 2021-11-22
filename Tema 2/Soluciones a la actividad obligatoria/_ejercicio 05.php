<?php
/*  La función recursiva termina cuando llega a 1.
El número de pasos se puede obtener con una variable global, haciendo uso de &GLOBALS, o pasando el dato de los pasos por referencia a la función */

function collatz($n)
{
    global $pasos;
    $pasos = $pasos +1;
    echo $n . "<br>";
    if ($n == 1){
        return 1;
    } elseif (($n % 2) == 0) {
        return collatz($n/2);
    } else {
        return collatz(3*$n+1);
    }
}
$pasos = 0;
collatz(4);
echo "<br>Número de pasos: $pasos";