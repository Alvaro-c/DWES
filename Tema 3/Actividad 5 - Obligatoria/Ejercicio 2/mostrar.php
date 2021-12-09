<?php
// archivo PHP para mostrar la información por pantalla
include('Vehiculo.class.php');


// se instancia un objeto de clase vehiculo y se aplican los métodos de su clase y padres para mostrar la info
$newVehiculo = new Vehiculo("negro", "1500");

$newVehiculo->circula();
$newVehiculo->anadir_persona(70);
echo "El peso del vehículo es ".$newVehiculo->getPeso(). " Kg";