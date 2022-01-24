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
	<title>Modificar Productos</title>
</head>

<body>
	<?php
	require 'cabecera.php';

	/*
	Si recibe datos por post procede a procesarlos y 
	actualizar la base de datos con ellos.
	*/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// ¿Está insertando o modificando?

		if (isset($_POST[':nombreAdd'])) {
			$actualizado = alta_producto($_POST);

			if ($actualizado === TRUE) echo "<p>Producto añadido correctamente</p>";
			else echo "<p>Error al actualizar los datos</p>";
		} else {
			$actualizado = actualizar_producto($_POST);

			if ($actualizado === TRUE) echo "<p>Producto actualizado correctamente</p>";
			else echo "<p>Error al actualizar los datos</p>";
		}
	}

	/*
	Si una categoría ha sido especificada en la url se cargan los productos de esta,
	sino se cargan todos los productos existentes.
	*/
	if (isset($_GET['codcat'])) {
		$categoria = $_GET['codcat'];
		$url = 'modificar_productos.php?codcat=' . $categoria;
		$productos = cargar_productos_categoria($categoria);
	} else {
		$url = 'modificar_productos.php';
		$productos = cargar_todos_productos();
	}

	if ($productos === FALSE) {
		echo "<p class='error'>Error al conectar con la base datos</p>";
		exit;
	}

	/*
	Se recogen los datos devueltos y se muestran en una tabla con un formulario para que
	los campos puedan ser cambiados.
	*/
	echo "<table>";
	echo "<tr><th>Código</th><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th><th>Descatalogado</th></tr>";

	if ($productos !== TRUE) {
		foreach ($productos as $producto) {
			$cod = $producto['CodProd'];
			$nom = $producto['Nombre'];
			$des = $producto['Descripcion'];
			$peso = $producto['Peso'];
			$stock = $producto['Stock'];
			$codprod = $producto['CodProd'];
			$descatalogado = $producto['Descatalogado'];

			echo "<tr>
				<td>$cod</td>
				<form action = '$url' method = 'POST'>
				<td><input name = ':nombre' value = '$nom'></td>
				<td><input name = ':descripcion' value = '$des'></td>
				<td><input name = ':peso' value = '$peso'></td>
				<td><input name = ':stock' type='number' value = '$stock'></td>
				<td><input name = ':descatalogado' type='number' value = '$descatalogado'></td>
				<input name = ':codprod'  type='hidden'  value = '$codprod'>
				<td><input type = 'submit' value='Modificar'></td>
				</form>
				</tr>";
		}
	} else {
		echo "<p>La categoría está vacía</p>";
	}
	/*
	Formulario para añadir producto a la categoría (solo si hay categoría especificada en el GET).
	*/
	if (isset($categoria)) {
		echo "<tr>
			<td>+</td>
			<form action = '$url' method = 'POST'>
			<td><input name = ':nombreAdd' placeholder = 'Nombre'></td>
			<td><input name = ':descripcionAdd' placeholder = 'Descripción'></td>
			<td><input name = ':pesoAdd' placeholder = 'Peso'></td>
			<td><input name = ':stockAdd' type='number' placeholder = 'Stock'></td>
			<input name = ':codcatAdd'  type = 'hidden' value='$categoria'>
			<td></td>
			<td><input type = 'submit' value='Insertar'></td>
			</form>
			</tr>";
	}

	echo "</table>";
	?>

</body>

</html>