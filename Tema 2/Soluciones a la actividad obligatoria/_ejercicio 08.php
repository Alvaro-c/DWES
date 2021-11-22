<?php
function palindromo($cadena)
{
    //Hacemos todos los reemplazos posibles: espacios en blanco, tildes, etc.
    echo "'" . $cadena . "'";
    $cadena = str_replace(' ', '', $cadena);
    $cadena = eliminar_tildes(strtolower($cadena));
    //La función strrev resuelve el ejercicio directamente.
    if ($cadena == strrev($cadena)) {
        echo " es un palíndromo";
    } else {
        echo " no es un palíndromo";
    }
}

include("_acentos.php");

$comprobar = "Ojo rojo";
palindromo($comprobar);
