<?php
/*use PHPMailer\PHPMailer\PHPMailer;
require dirname(__FILE__)."/../vendor/autoload.php";*/
require "bd.php";
function enviar_correos($carrito, $pedido, $correo){
	$cuerpo = crear_correo($carrito, $pedido, $correo);

	return enviar_correo_multiples("$correo, pedidos@empresafalsa.com", $cuerpo, "Pedido $pedido confirmado");
}
function crear_correo($carrito, $pedido, $correo){
	$texto = "<h1>Pedido nº $pedido </h1><h2>Restaurante: $correo </h2>";
	$texto .= "Detalle del pedido:";
	$productos = cargar_productos(array_keys($carrito));	
	$texto .= "<table>"; //abrir la tabla
	$texto .= "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Unidades</th></tr>";
	foreach($productos as $producto){
		$cod = $producto['CodProd'];
		$nom = $producto['Nombre'];
		$des = $producto['Descripcion'];
		$peso = $producto['Peso'];
		$unidades = $_SESSION['carrito'][$cod];									    
		$texto .= "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$unidades</td>
		<td> </tr>";
	}
	$texto .= "</table>";	
	return $texto;
}

function enviar_correo_multiples($lista_correos,  $cuerpo,  $asunto = ""){
	return True;
/*		$mail = new PHPMailer();		
		$mail->IsSMTP(); 					
		$mail->SMTPDebug  = 0;  // cambiar a 1 o 2 para ver errores
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "tls";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 587;                   
		$mail->Username   = "";  //usuario de gmail
		$mail->Password   = ""; //contraseña de gmail          
		$mail->SetFrom('noreply@empresafalsa.com', 'Sistema de pedidos');
		$mail->Subject    = $asunto;
		$mail->MsgHTML($cuerpo);
		//partir la lista de correos por la coma
		$correos = explode(",", $lista_correos);
		foreach($correos as $correo){
			$mail->AddAddress($correo, $correo);
		}
		if(!$mail->Send()) {
		  return $mail->ErrorInfo;
		} else {
		  return TRUE;
		}
*/	}	
