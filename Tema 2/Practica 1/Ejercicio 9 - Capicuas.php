<?php


function palindromo($string)
{

    $string = strtolower($string);

    if (strlen($string) % 2 == 0) {

        $half1 = substr($string, 0, (strlen($string) / 2));
        $half2 = substr($string, - (strlen($string) / 2));
        $half2 = strrev($half2);

        return comprueba($half1, $half2);
    } else {

        $half1 = substr($string, 0, floor(strlen($string) / 2));
        $half2 = substr($string, -floor(strlen($string) / 2));
        $half2 = strrev($half2);

        return comprueba($half1, $half2);
    }
}

function comprueba($half1, $half2)
{
    if ($half1 == $half2) {

        return true;
    } else {

        return false;
    }
}


function capicuas()
{

    for ($i = 1; $i < 10; $i++) {

        echo "$i <br>";
    }

    for ($i = 10; $i < 99999; $i++) {

        $num = strval($i);

        if (palindromo($num)) {

            echo "$i <br>";
        }
    }
}

capicuas();
