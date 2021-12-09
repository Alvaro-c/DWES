<?php

// Inclusión de todas las clases que se van a utilizar y de las que hereda
include('Vehiculo.class.php');
include('Cuatro_ruedas.class.php');
include('Dos_ruedas.class.php');
include('Coche.class.php');
include('Camion.class.php');

echo "Ejercicio 4<br><br>";

// instancia de objeto Dos_ruedas, modificación e impresión (dos veces)
$newDosRuedas = new Dos_ruedas("rojo", 150);
$newDosRuedas->anadir_persona(70);

echo "El peso del Dos Ruedas es de ". $newDosRuedas->getPeso(). " Kg";

$newDosRuedas->setColor("verde");
$newDosRuedas->setCilindrada(1000);

echo "<br><br>Después de las modificaciones: <br><br>";
echo $newDosRuedas->ver_atributo($newDosRuedas);

echo "<br><br>Creación del camión: <br><br>";


// instancia del objeto camión, modificación de sus atributos e impresión por pantalla
$newCamion = new Camion("blanco", 6000);
$newCamion->anadir_persona(84);
$newCamion->repintar("azul");
$newCamion->setNumero_puertas(2);
echo $newCamion->ver_atributo($newCamion);