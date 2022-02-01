<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'correo.php';
require_once 'bd.php';
/*comprueba que el usuario haya abierto sesión o devuelve*/
require 'sesiones_json.php';
if (!comprobar_sesion()) return;
$resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['CodRes']);
// Cuando se procesa el pedido se actualiza el stock restando los productos del carrito
$stock = actualizar_stock($_SESSION['carrito']);

if ($resul === FALSE || $stock === FALSE) {
	echo "FALSE";
} else {
	$correo = $_SESSION['usuario']['Correo'];
	$conf = enviar_correos($_SESSION['carrito'], $resul, $correo);
	echo "TRUE";
	//vaciar carrito	
	$_SESSION['carrito'] = [];
}