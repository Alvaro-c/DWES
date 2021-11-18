<?php

session_start();

session_destroy();

//echo '<p><a href="index.php"> Volver a inicio</a></p>';
header("Location: index.php");