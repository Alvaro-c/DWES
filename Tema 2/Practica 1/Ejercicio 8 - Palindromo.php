<?php

/* Escribe una función que reciba una cadena y compruebe si es un palíndromo. */


function palindromo($string)
{

    $string = strtolower($string);

    if (strlen($string) % 2 == 0) {
        // word with even letters, compare first with second half

        // make both halves
        $half1 = substr($string, 0, (strlen($string) / 2));

        $half2 = substr($string, - (strlen($string) / 2));

        // reverse second half
        $half2 = strrev($half2);

        // check both halves
        comprueba($string, $half1, $half2);

    } else {
        // word with odd letters, compare first half minus one with second half plus one

        // make both halves rounding to floor because it is an odd number of letters
        $half1 = substr($string, 0, floor(strlen($string) / 2));

        $half2 = substr($string, - floor(strlen($string) / 2));


        // reverse second half
        $half2 = strrev($half2);

        // check both halves
        comprueba($string, $half1, $half2);
    }
}

function comprueba($string, $half1, $half2)
{
    // compare them
    if ($half1 == $half2) {

        echo "La palabra $string es un palíndromo";
    } else {

        echo "La palabra $string no es un palíndromo";
    }
}

palindromo("reconocer");
