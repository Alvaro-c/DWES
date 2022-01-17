<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['pagina_inicio'])) {
		setcookie('pagina_inicio', $_POST['pagina_inicio'], time() + 3600 * 24);
	} else {
		setcookie('pagina_inicio', '', time() - 3600 * 24);
		$_COOKIE['pagina_inicio'] = Null;
	}

	// Ejercicio 11b
	if (isset($_POST['sin_stock'])) {
		setcookie('sin_stock', $_POST['sin_stock'], time() + 3600 * 24);
	} else {
		setcookie('sin_stock', '', time() - 3600 * 24);
		$_COOKIE['sin_stock'] = Null;
	}

}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Preferencias</title>
</head>
<?php require 'cabecera.php'; ?>
<h1>Preferencias</h1>
<form action="preferencias.php" method="POST">
	<input type="checkbox" id="pagina_inicio" name="pagina_inicio" value="carrito.php" <?php if (isset($_COOKIE['pagina_inicio'])) echo "checked"; ?>>
	<label for="pagina_inicio"> Ver carrito al acceder </label><br>
	<!-- Ejercicio 11 b -->
	<input type="checkbox" id="sin_stock" name="sin_stock" value="sin_stock" <?php if (isset($_COOKIE['sin_stock'])) echo "checked"; ?>>
	<label for="sin_stock"> Ver los productos sin stock </label><br>
	<input type="submit" value="Guardar">
</form>

</body>

</html>