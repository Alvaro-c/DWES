<?php





function comprobar_usuario($nombre, $clave) {

	// conexión a la BBDD
	$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
	$usuario = 'root';
	$pass = '';

	// Recuperación de todos los usuarios
	try {
		$bd = new PDO($cadena_conexion, $usuario, $pass);
		$sql = 'SELECT nombre, clave, rol FROM usuarios';
		$usuarios = $bd->query($sql);
		$array = $usuarios->fetchAll();
	} catch (PDOException $e) {
		echo 'Error con la base de datos: ' . $e->getMessage();
	}

	// Recorrido de los usuarios para ver si alguno coincide con el nombre y clave introducidos
	for ($i = 0; $i < count($array); $i++) {

		if ($nombre == $array[$i]['nombre'] && $clave == $array[$i]['clave']) {

			$usu['nombre'] = $nombre;
			$usu['rol'] = $array[$i]['rol'];
			return $usu;
		}
	}

	return false;
}


// El resto del ejercicio es como en el ejemplo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
	if ($usu == false) {
		$err = true;
		$usuario = $_POST['usuario'];
	} else {
		session_start();
		$_SESSION['usuario'] = $_POST['usuario'];
		$_SESSION['rol'] = $usu['rol'];
		header("Location: sesiones1_principal.php");
	}
}


?>
<!DOCTYPE html>
<html>

<head>
	<title>Formulario de login</title>
	<meta charset="UTF-8">
</head>

<body>
	<?php if (isset($_GET["redirigido"])) { // Esta linea se ejecutará cuando se haya ido a la pantalla principal in hacer login
		echo "<p>Haga login para continuar</p>";
	} ?>
	<?php if (isset($err) and $err == true) {
		echo "<p> revise usuario y contraseña</p>";
	} ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		Usuario
		<input value="<?php if (isset($usuario)) echo $usuario; ?>" id="usuario" name="usuario" type="text">
		Clave
		<input id="clave" name="clave" type="password">
		<input type="submit">
	</form>
</body>

</html>