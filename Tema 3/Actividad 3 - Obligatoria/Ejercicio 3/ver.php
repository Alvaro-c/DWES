<?php

session_start();

if(isset($_SESSION['name']) && isset($_SESSION['surname'])) {

    echo "Nombre y apellidos:";
    echo "<p>". $_SESSION['name'] . " ". $_SESSION['surname'];

    echo '<p><a href="index.php"> Volver a inicio</a></p>';

} else {

    echo "Aún no se han guardado el nombre y los apellidos";

    echo '<p><a href="index.php"> Volver a inicio</a></p>';
}