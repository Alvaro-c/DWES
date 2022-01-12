<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_admin();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Zona de administración</title>
</head>

<body>
    <?php require 'cabecera.php'; ?>
    <h1>Zona de administración</h1>
    <!--lista de vínculos con la forma 
		productos.php?categoria=1-->
    <ul>
        <li><a href='datos_usu.php'>Datos de los restaurantes</a></li>
    </ul>

    <?php




    ?>



</body>

</html>