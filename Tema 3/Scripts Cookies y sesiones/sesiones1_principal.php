<?php
session_start();
if (!isset($_SESSION['usuario'])) {	 // si accedo aquí por primera vez, esta variable no está setted y redirige a la pantalla de login
	header("Location: sesiones1_login.php?redirigido=true");
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

	if ($_SESSION['usuario'] == "admin") echo "<p><strong>Zona de administrador</strong></p>";
	
	echo "<p>Bienvenido " . $_SESSION['usuario']; "</p>"; ?>

	<br><br><a href="sesiones1_logout.php"> Salir <a>
</body>

</html>