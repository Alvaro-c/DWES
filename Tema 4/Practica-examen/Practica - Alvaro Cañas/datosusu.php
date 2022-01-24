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
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<?php
	require 'cabecera.php';

	/* ---- A modificar ----
	Si accedemos mediante POST, actualizamos los datos en la base de datos a través de la función actualizar_restaurante 
	Si la modificación en la base de datos ha sido correcta, mostramos el mensaje "Datos actualizados correctamente"
	En caso contrario, mostramos el mensaje "Error al actualizar los datos"
	*/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$actualizado = actualizar_restaurante($_POST);
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
	echo "<tr><th>Correo</th><th>País</th><th>CP</th><th>Ciudad</th><th>Dirección</th><th>Rol</th></tr>";
	foreach ($restaurantes as $restaurante) {
		$correo = $restaurante['Correo'];
		$pais = $restaurante['Pais'];
		$cp = $restaurante['CP'];
		$ciudad = $restaurante['Ciudad'];
		$direccion = $restaurante['Direccion'];
		$rol = $restaurante['Rol'];
		$codres = $restaurante['CodRes'];
		echo "<tr>
            <form action = 'datosusu.php' method = 'POST'>
            <td><input name = ':correo' value = '$correo'></td>
            <td><input name = ':pais' value = '$pais'></td>
            <td><input name = ':cp' value = '$cp'></td>
            <td><input name = ':ciudad' value = '$ciudad'></td>
            <td><input name = ':direccion' value = '$direccion'></td>
            <td><input name = ':rol' value = '$rol'></td>
            <input name = ':codres'  type='hidden'  value = '$codres'>
            <td><input type = 'submit' value='Modificar'></td>
			</form>
            </tr>";
	}
	echo "</table>";
	?>

</body>

</html>