<?php

// Inclusión de todas las clases que se van a utilizar y de las que hereda
include('Vehiculo.class.php');
include('Cuatro_ruedas.class.php');
include('Dos_ruedas.class.php');
include('Coche.class.php');
include('Camion.class.php');

echo "Ejercicio 5<br><br>";
$newCoche = new Coche("verde", 2100, 4);

// instancia del objeto coche, modificación de sus atributos e impresión por pantalla
$newCoche->anadir_cadenas_nieve(2);
$newCoche->anadir_persona(80);
$newCoche->repintar("azul");
$newCoche->quitar_cadenas_nieve(4);
$newCoche->repintar("negro");

echo "<br>";
$newCoche->ver_atributo($newCoche);

echo "<br>Nota: El atributo cadenas no ha podido cambiarse porque el número salía de los parámetros permitidos.";