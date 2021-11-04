<?php
$entero = 4; 
echo gettype($entero);
echo "<br>";
$entero = "hola";
echo gettype($entero);
echo "<br>";
$entero = "Hola";
$a = print "a";
echo "<br>";
echo gettype($a);
echo "<br>";
echo $a;
// $a = echo "a"; //error porque echo devuelve un void
echo "<br>";
$a = null;
echo gettype($a);

// Comentarios
// una linea
/* vairas
lineas */

// TIPOS PRIMITIVOS
// Boolean, integer, float, string
// TIPOS COMPUESTOS
// Array, Objects, Callbacks (pasar como argumento una función a otra función), iterables (objetos que se pueden recorrer)
// Dos tipos especiales
// resource (referencia a un recurso externo)  y NULL (Variable sin valor)

