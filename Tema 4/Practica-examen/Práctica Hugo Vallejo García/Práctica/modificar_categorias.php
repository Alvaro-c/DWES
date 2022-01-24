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
	<title>Modificar Categorías</title>
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
			$actualizado = alta_categoria($_POST);

			if ($actualizado === TRUE) echo "<p>Categoría añadida correctamente</p>";
			else echo "<p>Error al actualizar los datos</p>";
		} else {
			$actualizado = actualizar_categoria($_POST);

			if ($actualizado === TRUE) echo "<p>Categoría actualizada correctamente</p>";
			else echo "<p>Error al actualizar los datos</p>";
		}
	}

	/*
	Se cargan los datos de las categorías.
	*/
	$categorias = cargar_categorias();
	if ($categorias === FALSE) {
		echo "<p class='error'>Error al conectar con la base datos</p>";
		exit;
	}

	/*
	Se recogen los datos devueltos y se muestran en una tabla con un formulario para que
	los campos puedan ser cambiados.
	*/
	echo "<table>";
	echo "<tr><th>Nombre</th><th>Descripción</th><th>Descatalogado</th></tr>";
	foreach ($categorias as $categoria) {
		$nombre = $categoria['Nombre'];
		$descripcion = $categoria['Descripcion'];
		$codcat = $categoria['CodCat'];
		$descatalogado = $categoria['Descatalogado'];

		echo "<tr>
            <form action = 'modificar_categorias.php' method = 'POST'>
            <td><input name = ':nombre' value = '$nombre'></td>
            <td><input name = ':descripcion' value = '$descripcion'></td>
			<td><input name = ':descatalogado' type = 'number' value = '$descatalogado'></td>
            <input name = ':codcat'  type='hidden'  value = '$codcat'>
            <td><input type = 'submit' value='Modificar'></td>
			<td><a href='modificar_productos.php?codcat=$codcat'>Editar Productos</a></td>
			</form>
            </tr>";
	}

	/*
	Formulario para añadir categoría.
	*/
	echo "<tr>
            <form action = 'modificar_categorias.php' method = 'POST'>
            <td><input name = ':nombreAdd' placeholder = 'Nombre'></td>
            <td><input name = ':descripcionAdd' placeholder = 'Descripción'></td>
			<td></td>
            <td><input type = 'submit' value='Insertar'></td>
			</form>
            </tr>";
	echo "</table>";
	?>

</body>

</html>