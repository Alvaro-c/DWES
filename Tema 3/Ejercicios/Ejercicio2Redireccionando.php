<?php
echo "Redireccionado desde: ". $_SERVER["HTTP_REFERER"];
echo "<p> Usuario: " . $_GET['usuario'] . "</p>";
echo "<p> Contraseña: " . $_GET['clave'] . "</p>";