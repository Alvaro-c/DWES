<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
/* correo.php requere tener instalada la extensión PHPMAILER, por eso aparece comentada
	require 'correo.php'; */
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();

if (isset($_POST['tramiteSinStock'])) {
	require 'cabecera.php';

	tramitar_pedido(true);
	return;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Pedidos</title>
</head>

<body>
	<?php
	require 'cabecera.php';
	$carrito = $_SESSION['carrito'];
	$productosFaltantes = falta_stock($_SESSION['carrito']);

	if ($productosFaltantes == FALSE) {
		tramitar_pedido();
	} else {
		echo "<p>¡No tenemos stock de algunos productos seleccionados!</p>";
		echo "<p>Todavía puedes tramitar el pedido, pero aquí están los productos que nos faltan ahora mismo:</p>";

		echo "<table>";

		echo "<tr><th>Nombre</th><th>Descripción</th><th>Categoría</th><th>Unidades Pedidas</th><th>Unidades Faltantes</th></tr>";

		$infoProductos = cargar_sin_stock($productosFaltantes);

		foreach ($infoProductos as $producto) {
			$codProducto = $producto['CodProd'];
			$categoria = cargar_categoria($producto['CodCat']);

			echo "<tr>";

			echo "<td>" . $producto['Nombre'] . "</td>";
			echo "<td>" . $producto['Descripcion'] . "</td>";
			echo "<td>" . $categoria['Nombre'] . "</td>";
			echo "<td>" . $carrito[$codProducto] . "</td>";
			echo "<td>" . $productosFaltantes[$codProducto] . "</td>";

			echo "</tr>";
		}

		echo "</table> <br/>";

		$_SESSION['productosFaltantes'] = $productosFaltantes;

		echo "<form action = 'procesar_pedido.php' method = 'POST'>
		<input name = 'tramiteSinStock' type='hidden' value = 'tramiteSinStock'>
		<input type='submit' value='Tramitar Pedido'></form>";
	}

	function tramitar_pedido($sinStock = false)
	{
		if ($sinStock) {
			$resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['CodRes'], 1);

			if ($resul != FALSE) {
				$datos = [];

				$datos['codPed'] = $resul;
				$datos['productos'] = $_SESSION['productosFaltantes'];

				$resultSinStock = insertar_sin_stock($datos);
				$_SESSION['productosFaltantes'] = [];

				if ($resultSinStock) {
					mostrarFinal($resul != FALSE && $resultSinStock != FALSE);
				}
			}
		} else {
			$resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['CodRes']);
			mostrarFinal($resul);
		}
	}

	function mostrarFinal($exito)
	{
		if ($exito === FALSE) {
			echo "No se ha podido realizar el pedido<br>";
		} else {
			$correo = $_SESSION['usuario']['Correo'];
			echo "Pedido realizado con éxito. Se enviará un correo de confirmación a: $correo ";

			/* Este bloque comprueba que el correo se ha enviado correctamente con la extensión PHPMailer

			$conf = enviar_correos($_SESSION['carrito'], $resul, $correo);							
			if($conf!==TRUE){
				echo "Error al enviar: $conf <br>";
			};*/

			//vaciar carrito	
			$_SESSION['carrito'] = [];
			if (isset($_COOKIE['carrito'])) {
				setcookie('carrito', '', time() - 3600 * 24);
			}
		}
	}
	?>
</body>

</html>