<?php
session_start();
if (!isset($_SESSION['usuario'])) {	 // si accedo aquí por primera vez, esta variable no está setted y redirige a la pantalla de login
	header("Location: sesiones1_login.php?redirigido=true");
}


$array = array();
// Recuperación de info de usuarios para el admin 
if ($_SESSION['rol'] == "1") {

	try {

		$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
		$usuario = 'root';
		$pass = '';

		$bd = new PDO($cadena_conexion, $usuario, $pass);
		$sql = 'SELECT nombre, clave, rol FROM usuarios';
		$usuarios = $bd->query($sql);
		$array = $usuarios->fetchAll();
	} catch (PDOException $e) {
		echo 'Error con la base de datos: ' . $e->getMessage();
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Página principal</title>
	<meta charset="UTF-8">
</head>

<body>

	<?php

	echo "<p>Bienvenido " . $_SESSION['usuario'];
	"</p>";

	if ($_SESSION['rol'] == "1") {
		echo "<p><strong>Zona de administrador</strong></p>";

	?>


		<h3>Cambiar Rol: </h3>
		<form action="editar.php" method="post">
			<label for="cod">Codigo Usuario: </label><input type="text" id="cod" name="cod"><input type="submit">
		</form>
		<h2>Información de usuarios</h2>
		<table>
			<tr>
				<th>Nombre</th>
				<th>Clave</th>
				<th>Rol</th>
			</tr>



			<?php
			// imprimir en una tabla la info de los usuarios desde el array que tiene la consulta
			for ($i = 0; $i < count($array); $i++) {
			?>

				<tr>
					<td><?php echo $array[$i][0] ?></td>
					<td><?php echo $array[$i][1] ?></td>
					<td><?php echo $array[$i][2] ?></td>
				</tr>

		<?php

			}
		}
		?>

		</table>

		<br><br><a href="sesiones1_logout.php"> Salir <a>
</body>

</html>