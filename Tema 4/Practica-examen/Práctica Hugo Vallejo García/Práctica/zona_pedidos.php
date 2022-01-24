<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_responsable();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Gestion de Productos y Categorías</title>
</head>

<body>
	<?php require 'cabecera.php'; ?>
	<h1>Gestion de Productos y Pedidos</h1>
	
	<!--lista de vínculos -->
	<ul>
		<li><a href='modificar_categorias.php'> Modificar Categorías </a></li>
		<li><a href='modificar_productos.php'> Modificar Productos </a></li>
		<li><a href='bajas_prod_cat.php'> Eliminar Productos o Categorías </a></li>
		<li><a href='envios_pendientes.php'> Envíos Pendientes </a></li>
	</ul>

</body>

</html>