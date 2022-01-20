<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Cookie página de incio
	if (isset($_POST['pagina_inicio'])) {
		setcookie('pagina_inicio', $_POST['pagina_inicio'], time() + 3600 * 24);
		$_COOKIE['pagina_inicio'] = $_POST['pagina_inicio'];
	} else {
		setcookie('pagina_inicio', '', time() - 3600 * 24);
		$_COOKIE['pagina_inicio'] = Null;
	}
	// Cookie stock
	if (isset($_POST['stock'])) {
		setcookie('stock', $_POST['stock'], time() + 3600 * 24);
		$_COOKIE['stock'] = $_POST['stock'];
	} else {
		setcookie('stock', '', time() - 3600 * 24);
		$_COOKIE['stock'] = Null;
	}
	// Cookie carrito
	if (isset($_POST['carrito'])) {
		setcookie('carrito', json_encode($_SESSION['carrito']), time() + 3600 * 24);
		$_COOKIE['carrito'] = json_encode($_SESSION['carrito']);
	} else {
		setcookie('carrito', '', time() - 3600 * 24);
		$_COOKIE['carrito'] = Null;
	}

    // Cookie descatalogado
	if (isset($_POST['descatalogado'])) {
		setcookie('descatalogado', $_POST['descatalogado'], time() + 3600 * 24);
		$_COOKIE['descatalogado'] = $_POST['descatalogado'];
	} else {
		setcookie('descatalogado', '', time() - 3600 * 24);
		$_COOKIE['descatalogado'] = Null;
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
	<input type="checkbox" id="stock" name="stock" value=1 <?php if (isset($_COOKIE['stock'])) echo "checked"; ?>>
	<label for="stock"> Ocultar productos sin stock </label><br>
	<input type="checkbox" id="carrito" name="carrito" value=1 <?php if (isset($_COOKIE['carrito'])) echo "checked"; ?>>
	<label for="carrito"> Guardar el carrito entre sesiones </label><br>
    <?php
    if($_SESSION['usuario']['Rol'] == 2){
    ?>
    <input type="checkbox" id="descatalogado" name="descatalogado" value=1 <?php if (isset($_COOKIE['descatalogado'])) echo "checked"; ?>>
    <label for="descatalogado"> Ver descatalogados </label><br><br>
	<?php }
    ?>

    <input type="submit" value="Guardar">
</form>

</body>

</html>