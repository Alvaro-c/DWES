<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_gestion();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <title>Zona de pedidos</title>
</head>
<body>
<?php require 'cabecera.php';?>
<h1>Zona de pedidos</h1>
<!--lista de vínculos con la forma
productos.php?categoria=1-->

<ul>
    <li><a href="modificar_categorias.php">Modificar categorias</a></li>
    <li><a href="modificar_productos.php">Modificar productos</a></li>
</ul>

</body>
</html>