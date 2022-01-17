<?php 
/*comprueba que el usuario haya abierto sesión o redirige*/
require_once 'sesiones.php';
comprobar_sesion();
$cod = $_POST['cod'];
$unidades = (int)$_POST['unidades'];
/*si existe el código sumamos las unidades*/
if(isset($_SESSION['carrito'][$cod])){
	$_SESSION['carrito'][$cod] += $unidades;
}else{
	$_SESSION['carrito'][$cod] = $unidades;		
}
$cat = $_SESSION['categoria'];

// comprobar si el user quiere guardar el carrito (preferencias del user)
if (isset($_COOKIE['carrito'])){
	setcookie('carrito', json_encode($_SESSION['carrito']) , time() + 3600 * 24);
}
// Ejercicio 1:
header("Location: productos.php?categoria=$cat");

//header("Location: carrito.php");
