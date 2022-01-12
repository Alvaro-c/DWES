<?php
use PHPMailer\PHPMailer\PHPMailer;
require dirname(__FILE__)."/../vendor/autoload.php";
/*include "PHPMailer.php";
include "SMTP.php";
include "exception.php";*/
function enviar_correos($carrito, $pedido, $correo){
	$cuerpo = crear_correo($carrito, $pedido, $correo);
	return enviar_correo_multiples("$correo, pedidos@empresafalsa.com", 
                        	$cuerpo, "Pedido $pedido confirmado");
}
function crear_correo($carrito, $pedido, $correo){
	$texto = "<h1>Pedido nº $pedido </h1><h2>Restaurante: $correo </h2>";
	$texto .= "Detalle del pedido:";
	$productos = cargar_productos(array_keys($carrito));	
	$texto .= "<table>"; //abrir la tabla
	$texto .= "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Unidades</th></tr>";
	// Ejercicio 6
	$pesoTotal = 0;
	foreach($productos as $producto){
		
		$cod = $producto['CodProd'];
		$nom = $producto['Nombre'];
		$des = $producto['Descripcion'];
		$peso = $producto['Peso'];
		$unidades = $_SESSION['carrito'][$cod];	
		// Ejercicio 6
		$pesoTotal = $pesoTotal + ($peso * $unidades);								    
		$texto .= "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$unidades</td>
		<td> </tr>";
	}
	// Ejercicio 6
	$texto .= "</table>". "<p> Peso total del pedido: ". $pesoTotal."</p>";	
	return $texto;
}
function enviar_correo_multiples($lista_correos,  $cuerpo,  $asunto = ""){
		$mail = new PHPMailer();		
		$mail->IsSMTP(); 		
		$datosServidor = leer_servidor_correo('servidor_correo.xml', 'servidor_correo_xsd');			
		$mail->SMTPDebug  = 0;  // cambiar a 1 o 2 para ver errores
		$mail->SMTPAuth   = $datosServidor[0];                  
		$mail->SMTPSecure = $datosServidor[1];                 
		$mail->Host       = $datosServidor[2];      
		$mail->Port       = $datosServidor[3];                   
		$mail->Username   = $datosServidor[4];  //usuario de gmail
		$mail->Password   = $datosServidor[5]; //contraseña de gmail          
		$mail->SetFrom('noreply@empresafalsa.com', 'Sistema de pedidos');
		$mail->Subject    = $asunto;
		$mail->MsgHTML($cuerpo);
		/*partir la lista de correos por la coma*/
		$correos = explode(",", $lista_correos);
		foreach($correos as $correo){
			$mail->AddAddress($correo, $correo);
		}
		if(!$mail->Send()) {
		  return $mail->ErrorInfo;
		} else {
		  return TRUE;
		}
	}	
