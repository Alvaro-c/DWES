<?php

// Inclusión de todas las clases que se van a utilizar y de las que hereda
include('Vehiculo.class.php');
include('Cuatro_ruedas.class.php');
include('Dos_ruedas.class.php');
include('Coche.class.php');
include('Camion.class.php');

echo "Ejercicio 2<br>";

// instancia de un nuevo Vehiculo y aplicación de métodos
$newVehiculo = new Vehiculo("negro", "1500");

$newVehiculo->circula();
$newVehiculo->anadir_persona(70);
echo "El peso del vehículo es ".$newVehiculo->getPeso(). " Kg <br>";

echo "<br>Ejercicio 3 <br>";

// instancia de un nuevo Coche, se aplican metodos (añadir personas y cadenas) y se muestra
$newCoche = new Coche("verde", 1400); 
$newCoche->anadir_persona(2*65);
echo "El peso del coche es ".$newCoche->getPeso(). " Kg <br>";

$newCoche->anadir_cadenas_nieve(2);
echo "El Coche es ".$newCoche->getColor(). " y tiene ". $newCoche->getNumero_cadenas_nieve(). " cadenas para la nieve<br>";


// instanciación de un Dos_ruedas, modificación con métodos y muestra por pantalla
$newDosRuedas = new Dos_ruedas("negro", 120);

$newDosRuedas->anadir_persona(80);
$newDosRuedas->poner_gasolina(20);

echo "El color de 'dos ruedas' es ". $newDosRuedas->getColor(). " y el peso es ". $newDosRuedas->getPeso(). " Kg <br>";

// instanciación de un Camion, modificación con métodos y muestra por pantalla
$newCamion = new Camion("azul", 10000); // Error si pongo más o menos de dos argumentos ¿?
$newCamion->setLongitud(10);
$newCamion->setNumero_puertas(2);
$newCamion->anadir_remolque(5);
$newCamion->anadir_persona(80);

echo "El color del camión es ". $newCamion->getColor(). ", pesa ". $newCamion->getPeso(). " KG, mide ". $newCamion->getLongitud(). " metros y tiene ". $newCamion->getNumero_puertas(). " puertas<br>";