<?php
echo "Redireccionado desde: ". $_SERVER["HTTP_REFERER"];
echo "<p> Usuario: " . $_GET['usuario'] . "</p>";
echo "<p> Contraseña: " . $_GET['clave'] . "</p>";

// La variable POST en este archivo no contiene nada. 
// Si queremos recuperar esa información tendremos que llamar a la BBDD o a la variable sesión