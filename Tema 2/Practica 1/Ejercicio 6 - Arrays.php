<?php

/* Escribe una función que reciba un array de números, y un número, el límite. La función
tiene que devolver un nuevo array que contenga solo los elementos del array original
menores que el límite ordenados de menor a mayor respetando las claves.
*/

$array = array(9, 8, 7, 6, 5, 4, 3, 2, 1);
$limite = 5;



function limite($array, $limite)
{

    $nuevoArray = array();

    foreach ($array as $codigo => $valor) {

        if ($valor < $limite) {

            $nuevoArray[$codigo] = $valor;
        }
    }

    asort($nuevoArray);

    print_r($nuevoArray);
}

limite($array, $limite);
