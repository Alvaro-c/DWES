<?php

session_start();

session_destroy();
//unset($_SESSION);

//echo '<p><a href="guardar_usuarios.php"> Volver a inicio</a></p>';
header("Location: guardar_usuarios.php");