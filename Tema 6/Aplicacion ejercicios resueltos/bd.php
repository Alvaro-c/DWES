<?php
function leer_config($nombre, $esquema)
{
	$config = new DOMDocument();
	$config->load($nombre);
	$res = $config->schemaValidate($esquema);
	if ($res === FALSE) {
		throw new InvalidArgumentException("Revise fichero de configuración");
	}
	$datos = simplexml_load_file($nombre);
	$ip = $datos->xpath("//ip");
	$nombre = $datos->xpath("//nombre");
	$usu = $datos->xpath("//usuario");
	$clave = $datos->xpath("//clave");
	$cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
	$resul = [];
	$resul[] = $cad;
	$resul[] = $usu[0];
	$resul[] = $clave[0];
	return $resul;
}

function comprobar_usuario($nombre, $clave)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//$preparada = $bd->prepare("SELECT codRes, correo, rol, clave FROM restaurantes WHERE correo = :nombre");
	//$preparada->execute(array(':nombre' => $nombre));
	$preparada = $bd->prepare("SELECT CodRes, Correo, Rol, Clave FROM restaurantes WHERE Correo = ?");
	$preparada->execute(array($nombre));
	if ($preparada->rowCount() === 1) {
		$datos =  $preparada->fetch();
		if (password_verify($clave, $datos['Clave'])) {
			return $datos;
		} else {
			return FALSE;
		}
	} else {
		return FALSE;
	}
}

function cargar_categorias()
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT codCat, nombre FROM categorias";
	$resul = $bd->query($ins);
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {
		return FALSE;
	}
	//si hay 1 o más
	return $resul;
}
function cargar_categoria($codCat)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT nombre, descripcion FROM categorias WHERE codcat = $codCat";
	$resul = $bd->query($ins);
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {
		return FALSE;
	}
	//si hay 1 o más
	return $resul->fetch();
}
function cargar_productos_categoria($codCat)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$sql = "SELECT * FROM productos WHERE Codcat  = $codCat";
	$resul = $bd->query($sql);
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {
		return FALSE;
	}
	//si hay 1 o más
	return $resul;
}
// recibe un array de códigos de productos
// devuelve un cursor con los datos de esos productos
function cargar_productos($codigosProductos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$texto_in = implode(",", $codigosProductos);
	if ($texto_in == '') {
		return FALSE;
	} else {
		$ins = "SELECT * FROM productos WHERE codProd in ($texto_in)";
		$resul = $bd->query($ins);
		if (!$resul) {
			return FALSE;
		}
		return $resul;
	}
}
function insertar_pedido($carrito, $codRes)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$bd->beginTransaction();
	$hora = date("Y-m-d H:i:s", time());
	// insertar el pedido
	$sql = "INSERT INTO pedidos(Fecha, Enviado, Restaurante) VALUES('$hora',0, $codRes)";
	$resul = $bd->query($sql);
	if (!$resul) {
		return FALSE;
	}
	// coger el id del nuevo pedido para las filas detalle
	$pedido = $bd->lastInsertId();
	// insertar las filas en pedidoproductos
	foreach ($carrito as $codProd => $unidades) {
		$sql = "INSERT INTO pedidosproductos(CodPed, CodProd, Unidades) VALUES( $pedido, $codProd, $unidades)";
		$resul = $bd->query($sql);
		if (!$resul) {
			$bd->rollback();
			return FALSE;
		}
	}
	$bd->commit();
	return $pedido;
}

function getCategoria($CodProd) {

	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

		$ins = "SELECT CodCat FROM productos WHERE CodProd = $CodProd";
		$resul = $bd->query($ins);
		if (!$resul) {
			return FALSE;
		}
		return $resul;
}


// Ejercicio 6: Esta función se llama cuando se procesa un pedido. Actualiza el stock restando los productos del carrito
function actualizar_stock($productos){

	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	// para cada producto obtengo el stock actual y el que debería tener
	foreach ($productos as $CodProd => $unidades) {

		// Obtengo el stock original
		$query = "select Stock from productos where CodProd = $CodProd";
		$stockOrig = $bd->query($query);
		$stockOrig = $stockOrig->fetchALL(PDO::FETCH_ASSOC);
		$stockOrig = $stockOrig[0]['Stock'];
		
		// Actualizo el producto en concreto con el nuevo stock
		$nuevoStock = $stockOrig - $unidades;

		$query = "UPDATE pedidos.productos t SET t.Stock = $nuevoStock WHERE t.CodProd = $CodProd;";
		$result = $bd->query($query);
		// Si ha habido algún error, devuelve falso y no continúa
		if (!$result) {
			return false;
		}

	}

	return true;
}