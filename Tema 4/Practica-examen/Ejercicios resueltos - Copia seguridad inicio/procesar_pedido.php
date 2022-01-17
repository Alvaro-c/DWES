<?php
	/*comprueba que el usuario haya abierto sesión o redirige*/
	/* correo.php requere tener instalada la extensión PHPMAILER, por eso aparece comentada
	require 'correo.php'; */
	require 'sesiones.php';
	require_once 'bd.php';
	comprobar_sesion();
?>	
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Pedidos</title>		
	</head>
	<body>
	<?php 
	require 'cabecera.php';			
	$resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['CodRes']);
	if($resul === FALSE){
		echo "No se ha podido realizar el pedido<br>";			
	}else{
		$correo = $_SESSION['usuario']['Correo'];
		echo "Pedido realizado con éxito. Se enviará un correo de confirmación a: $correo ";
/* Este bloque comprueba que el correo se ha enviado correctamente con la extensión PHPMailer
		$conf = enviar_correos($_SESSION['carrito'], $resul, $correo);							
		if($conf!==TRUE){
			echo "Error al enviar: $conf <br>";
		};*/		
		//vaciar carrito	
		$_SESSION['carrito'] = [];
		if (isset($_COOKIE['carrito'])){
			setcookie('carrito', '' , time() - 3600 * 24);
		}
		}		
	?>		
	</body>
</html>
	