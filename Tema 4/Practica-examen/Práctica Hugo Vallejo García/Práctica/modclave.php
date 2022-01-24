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
	<title>Claves de usuarios</title>
</head>

<body>
	<?php
	require 'cabecera.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$actualizado = actualizar_clave($_POST);
		if ($actualizado === TRUE) {
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