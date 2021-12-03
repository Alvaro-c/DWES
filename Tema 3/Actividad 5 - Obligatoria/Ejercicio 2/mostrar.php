<?php

include('Vehiculo.class.php');

$newVehiculo = new Vehiculo("negro", "1500");

$newVehiculo->circula();
$newVehiculo->anadir_persona(70);
echo "El peso del vehículo es ".$newVehiculo->getPeso(). " Kg";