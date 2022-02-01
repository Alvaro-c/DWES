<?php
/*comprueba que el usuario haya abierto sesión o devuelve*/
require 'sesiones_json.php';
if (!comprobar_sesion()) return;
$cod = $_POST['cod'];
$unidades = (int)$_POST['unidades'];
/*si existe el código sumamos las unidades*/
if (isset($_SESSION['carrito'][$cod])) {
	$_SESSION['carrito'][$cod] += $unidades;
} else {
	$_SESSION['carrito'][$cod] = $unidades;
}