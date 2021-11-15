<?php
session_start(); // Esta instrucción sirve para unirse a la sesión creada por el anterior script. La instrucción es la misma
echo "La variable count vale: " . $_SESSION['count'];

// Este script tiene acceso a la variable sesión que viene del otro script 
//y une la info de la sesión que viene del origen, a su propia sesión
// Por tanto, la info se mantiene de un script a otro
// Iniciar sesión no es más que una cookie