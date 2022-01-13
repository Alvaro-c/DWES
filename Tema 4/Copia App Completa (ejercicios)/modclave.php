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
	<title>Listado de usuarios</title>
</head>

<body>
	<?php
	require 'cabecera.php';

	/* ---- A modificar ----
	Si accedemos mediante POST, actualizamos los datos en la base de datos a través de la función actualizar_restaurante 
	Si la modificación en la base de datos ha sido correcta, mostramos el mensaje "Datos actualizados correctamente"
	En caso contrario, mostramos el mensaje "Error al actualizar los datos"
	*/

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$actualizado = actualizar_clave($_POST);

		if ($actualizado) {
			echo "<p>Datos actualizados correctamente</p>";
		} else {
			echo "<p>Error al actualizar los datos</p>";
		}
	}


	$restaurantes = cargar_restaurantes();
	if ($restaurantes === FALSE) {
		echo "<p class='error'>Error al conectar con la base datos</p>";
		exit;
	}

	echo "<table>"; //abrir la tabla
	echo "<tr><th>Correo</th><th>Clave</th></tr>";
	foreach ($restaurantes as $restaurante) {
		$correo = $restaurante['Correo'];
		$clave = $restaurante['Clave'];
		$codres = $restaurante['CodRes'];
		echo "<tr>
            <form action = 'modclave.php' method = 'POST'>
            <td><input name = ':correo' value = '$correo'></td>
            <td><input name = ':clave' value = '$clave'></td>
            <input name = ':codres'  type='hidden'  value = '$codres'>
            <td><input type = 'submit' value='Modificar'></td>
			</form>
            </tr>";
	}
	echo "</table>";
	?>

</body>

</html>