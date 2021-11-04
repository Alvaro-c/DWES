<?php


/* Nº 7 Escribe una función que reciba una array con valores numéricos y determine cuántos
son positivos y cuántos son negativos. También debe mostrar dos arrays, uno conteniendo
los números positivos de menor a mayor y otro devolviendo los números negativos de mayor
a menor.
*/

$array = array(1, 3, 4, 5, 6, 5, 4, 3, 2, 24, 5, 6, 7);

function evenOdd($array)
{

    $even = 0;
    $odd = 0;
    $evenArray = array();
    $oddArray = array();

    foreach ($array as $num) {

        if ($num % 2 == 0) {

            $even++;
            array_push($evenArray, $num);
        } else {

            $odd++;
            array_push($oddArray, $num);
        }
    }

    sort($evenArray);
    rsort($oddArray);

    echo "Hay $even números pares y son: ";
    print_r($evenArray);
    echo "<br>";
    echo "Hay $odd números pares y son: ";
    print_r($oddArray);
}


evenOdd($array);
