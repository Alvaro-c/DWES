<?php 
/*comprueba que el usuario haya abierto sesión o redirige*/
require_once 'sesiones.php';
comprobar_sesion();
$cod = $_POST['cod'];
$unidades = $_POST['unidades'];
/*si existe el código restamos las unidades, con mínimo de 0*/
if(isset($_SESSION['carrito'][$cod])){		
	$_SESSION['carrito'][$cod] -= $unidades;
	if($_SESSION['carrito'][$cod] <= 0){
		unset($_SESSION['carrito'][$cod]);
	}
	// comprobar si el user quiere guardar el carrito (preferencias del user)
	if (isset($_COOKIE['carrito'])){
		setcookie('carrito', json_encode($_SESSION['carrito']) , time() + 3600 * 24);
	}
}
header("Location: carrito.php");
