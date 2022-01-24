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

/*
Función que devuelve:
a) Una array con los productos y cantidades que faltan.
b) Falso en caso de que no falte nada.

Variables:
$carrito es el carrito que va a analizar.
*/
function falta_stock($carrito)
{
	$productos = cargar_productos(array_keys($carrito));
	$productosFaltantes = [];

	foreach ($productos as $producto) {
		$codProducto = $producto['CodProd'];
		$stockProducto = $producto['Stock'];

		$unidadesCarrito = $carrito[$codProducto];

		if ($unidadesCarrito > $stockProducto) {
			$productosFaltantes[$codProducto] = $unidadesCarrito - $stockProducto;
		}
	}

	if (empty($productosFaltantes)) {
		return FALSE;
	} else {
		return $productosFaltantes;
	}
}

/*
Función que devuelve:
Los datos de los productos los cuales se encuentren en la array pasada.

Variables:
$productos_sin_stock contiene la array de productos.
*/
function cargar_sin_stock($productos_sin_stock)
{
	return cargar_productos(array_keys($productos_sin_stock));
}

/*
Función que:
Inserta en la tabla 'pedidospendientes' los productos que han sido pedidos y necesitan nuevo stock

Variables:
$envios_pendientes array con los datos necesarios para la inserción.
*/
function insertar_sin_stock($envios_pendientes)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$bd->beginTransaction();

	foreach ($envios_pendientes['productos'] as $producto => $cantidad) {
		$sql = "INSERT INTO productospendientes(CodPed, CodProd, UdPend) 
		VALUES(" . $envios_pendientes['codPed'] . ",  $producto, $cantidad)";

		$resul = $bd->query($sql);

		if (!$resul) {
			return FALSE;
		}
	}

	$bd->commit();
	return TRUE;
}

/*
Esta funcion inserta en la tabla productos los datos pasado por
una array (de manera preparada)
*/
function alta_producto($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	// Preparamos la query
	$preparada = $bd->prepare("INSERT INTO productos (Nombre, Descripcion, Peso, Stock, CodCat)
	VALUES(:nombreAdd,
	:descripcionAdd,
	:pesoAdd,
	:stockAdd,
	:codcatAdd)");

	//La ejecutamos con sus datos
	$resul = $preparada->execute($datos);
	return $resul;
}

/*
Esta funcion inserta en la tabla categorías los datos pasado por
una array (de manera preparada)
*/
function alta_categoria($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	// Preparamos la query
	$preparada = $bd->prepare("INSERT INTO categorias (Nombre, Descripcion)
	VALUES(:nombreAdd,
	:descripcionAdd)");

	//La ejecutamos con sus datos
	$resul = $preparada->execute($datos);
	return $resul;
}

/*
Esta función comprueba si el producto a eleminar esta en pendiente o pedidos.
Si es así simplemente se descataloga, sino el producto es eliminado de la tabla de productos.

Devuleve:

TRUE si es eliminado
FALSE si es descatalogado
*/
function eliminar_producto($prodCod)
{
	$codProd = [];
	$codProd[':codProd'] = $prodCod;
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	$bd->beginTransaction();
	$preparada = $bd->prepare("SELECT CodProd FROM pedidosproductos WHERE CodProd = :codProd");
	$preparada->execute($codProd);

	$preparada2 = $bd->prepare("SELECT CodProd FROM productospendientes WHERE CodProd = :codProd");
	$preparada2->execute($codProd);

	if ($preparada->rowCount() === 0 && $preparada2->rowCount() === 0) {
		$eliminacion = $bd->prepare("DELETE FROM productos WHERE CodProd = :codProd");
		$resultado = $eliminacion->execute($codProd);

		if (!$resultado) $bd->rollBack();
		else $bd->commit();

		return TRUE;
	} else {
		$descatalogacion = $bd->prepare("UPDATE productos SET Descatalogado = 1 WHERE CodProd = :codProd");
		$resultado = $descatalogacion->execute($codProd);

		if (!$resultado) $bd->rollBack();
		else $bd->commit();

		return FALSE;
	}

	$bd->commit();
}

/*
Esta función comprueba si cualquier producto de la categoría indicada esta en pedidos o pendientes.
Si es así simplemente se descataloga, sino el producto es eliminado de la tabla de productos.

Después la categoría es eliminada si no quedan productos de la misma o descatalogada.

Devuleve:

TRUE si es eliminada
FALSE si es descatalogada
*/
function eliminar_categoria($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$bd->beginTransaction();

	$productos_categoria = cargar_productos_categoria($datos[':codcat']);

	if ($productos_categoria !== TRUE)
		foreach ($productos_categoria as $producto) {
			eliminar_producto($producto['CodProd']);
		}

	$preparada = $bd->prepare("SELECT * FROM productos WHERE CodCat=:codcat");
	$preparada->execute($datos);

	if ($preparada->rowCount() === 0) {
		$preparada2 = $bd->prepare("DELETE FROM categorias WHERE CodCat=:codcat");
		$resultado = $preparada2->execute($datos);

		if (!$resultado) $bd->rollBack();
		else $bd->commit();
		return TRUE;
	} else {
		$preparada2 = $bd->prepare("UPDATE categorias SET Descatalogado = 1 WHERE CodCat=:codcat");
		$resultado = $preparada2->execute($datos);

		if (!$resultado) $bd->rollBack();
		else $bd->commit();
		return FALSE;
	}

	$bd->commit();
}
function leer_servidor($nombre, $esquema)
{
	$config = new DOMDocument();
	$config->load($nombre);
	$res = $config->schemaValidate($esquema);
	if ($res === FALSE) {
		throw new InvalidArgumentException("Revise fichero de servidor de correo");
	}
	$datos = simplexml_load_file($nombre);
	$SMTPAuth = $datos->xpath("//SMTPAuth");
	$SMTPSecure = $datos->xpath("//SMTPSecure");
	$Host = $datos->xpath("//Host");
	$Port = $datos->xpath("//Port");
	$Username = $datos->xpath("//Username");
	$Password = $datos->xpath("//Password");
	$resul = array($SMTPAuth, $SMTPSecure, $Host, $Port, $Username, $Password);
	return $resul;
}

function leer_cookie($nombre_cookie, $valor_por_defecto = FALSE)
{
	if (!isset($_COOKIE[$nombre_cookie])) {
		return $valor_por_defecto;
	} else {
		return $_COOKIE[$nombre_cookie];
	}
}

function actualizar_restaurante($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$preparada = $bd->prepare("UPDATE restaurantes SET 
	Correo = :correo,
	Pais = :pais,
	Cp = :cp,
	Ciudad = :ciudad,
	Direccion = :direccion,
	Rol = :rol
	WHERE CodRes = :codres");
	$resul = $preparada->execute($datos);
	return $resul;
}

function actualizar_clave($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$preparada = $bd->prepare("UPDATE restaurantes SET
	Clave = :clave,
	Correo = :correo 
	WHERE CodRes = :codres");
	$datos[':clave'] =  password_hash($datos[':clave'], PASSWORD_BCRYPT);
	$resul = $preparada->execute($datos);
	return $resul;
}

/*
Función que actualiza los datos de una categoría a través
de los datos pasados por una array. ($datos)
*/
function actualizar_categoria($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$preparada = $bd->prepare("UPDATE categorias SET
	Nombre = :nombre,
	Descripcion = :descripcion,
	Descatalogado = :descatalogado
	WHERE CodCat = :codcat");

	$resul = $preparada->execute($datos);
	return $resul;
}

/*
Función que actualiza los datos de un producto a través
de los datos pasados por una array. ($datos)
*/
function actualizar_producto($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$preparada = $bd->prepare("UPDATE productos SET
	Nombre = :nombre,
	Descripcion = :descripcion ,
	Peso = :peso,
	Stock = :stock,
	Descatalogado = :descatalogado
	WHERE CodProd = :codprod");

	$resul = $preparada->execute($datos);
	return $resul;
}

function alta_restaurante($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//Buscamos si ya exite el restaurante en la base de datos.
	$preparada = $bd->prepare("SELECT codRes, correo, rol, clave from restaurantes where correo = ?");
	$preparada->execute(array($datos[0]));
	//Si existe, devolvemos falso.
	if ($preparada->rowCount() === 1) {
		return false;
	} else {
		// en caso contrario, preparamos la consulta, hasheamos la contraseña y lo guardamos en la base de datos.
		$preparada = $bd->prepare("INSERT INTO restaurantes (Correo, Clave, Rol) VALUES (?,?,?)");
		$datos[1] = password_hash($datos[1], PASSWORD_BCRYPT);
		$resul = $preparada->execute($datos);
	}
	return $resul;
}

/*
Hace un join para pasar todos los productos pendientes con sus pedidos y restaurantes.
*/
function cargar_envios_pendientes()
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$query = "SELECT * FROM productospendientes PP JOIN PEDIDOS P JOIN RESTAURANTES R JOIN PRODUCTOS PR WHERE R.CodRes = P.Restaurante AND PP.CodPed = P.CodPed AND PP.CodProd = PR.CodProd";

	$resul = $bd->query($query);
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {
		return TRUE;
	}

	return $resul->fetchALL(PDO::FETCH_ASSOC);
}

/*
Actualiza las unidades faltantes o elimina una fila dependiendo de estas.
*/
function actualizar_envio_pendiente($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$codPend = $datos[':codpend'];
	$codPed = $datos[':codped'];
	$udPed = $datos[':udped'];

	if ($datos[':udped'] <= 0) {
		$datos = array(':codpend' => $codPend);

		$preparada = $bd->prepare("DELETE FROM productospendientes WHERE CodPend = :codpend");
		$resul = $preparada->execute($datos);

		$pedArray = array(':codped' => $codPed);
		
		// Comprobamos si al pedido le quedan artículos pendientes y cambiamos enviado a 0 si no le quedan.
		if (!tienePedidosPendientes($pedArray)) {
			$cambiarEnviado = $bd->prepare("UPDATE pedidos SET Enviado = 0 WHERE CodPed = :codped");
			$cambiarEnviado->execute($pedArray);
		}
	} else {
		$datos = array(':codpend' => $codPend, ':udped' => $udPed);

		$preparada = $bd->prepare("UPDATE productospendientes SET 
		UdPend = :udped
		WHERE CodPend = :codpend");
			$resul = $preparada->execute($datos);
	}

	return $resul;
}

/*
Devuelve si un pedido tiene productos pendientes o no.
*/
function tienePedidosPendientes($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	$preparada = $bd->prepare("SELECT * FROM productospendientes WHERE CodPed = :codped");
	$preparada->execute($datos);

	if ($preparada->rowCount() == 0)
		return false;

	return true;
}

function cargar_categorias($verDescatalogados = true)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT Descatalogado, CodCat, Nombre, Descripcion FROM categorias";

	if (!$verDescatalogados)
		$ins .= " WHERE Descatalogado = 0";

	$resul = $bd->query($ins);
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {
		return FALSE;
	}
	//si hay 1 o más
	return $resul->fetchALL(PDO::FETCH_ASSOC);
}

function cargar_categoria($codCat)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT Nombre, Descripcion FROM categorias WHERE Codcat = $codCat";
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

function cargar_productos_categoria($codCat, $verDescatalogados = true)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$sql = "SELECT * FROM productos WHERE Codcat  = $codCat AND Stock >= " . leer_cookie('stock', 0);

	if (!$verDescatalogados) {
		$sql .= " AND Descatalogado = 0";
	}

	$resul = $bd->query($sql);
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {
		return TRUE;
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
		$ins = "SELECT * FROM productos WHERE CodProd IN($texto_in)";
		$resul = $bd->query($ins);
		if (!$resul) {
			return FALSE;
		}
		return $resul;
	}
}

// devuelve un cursor con los datos de todos productos
function cargar_todos_productos()
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	$ins = "SELECT * FROM productos";
	$resul = $bd->query($ins);
	if (!$resul) {
		return FALSE;
	}
	return $resul;
}

function cargar_restaurantes()
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT * FROM restaurantes";
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

function comprobar_usuario($nombre, $clave)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//$preparada = $bd->prepare("SELECT codRes, correo, rol, clave from restaurantes where correo = :nombre");
	//$preparada->execute(array(':nombre' => $nombre));
	$preparada = $bd->prepare("SELECT CodRes, Correo, Rol, Clave from restaurantes where Correo = ?");
	$preparada->execute(array($nombre));
	if ($preparada->rowCount() === 1) {
		$datos =  $preparada->fetch();
		if (password_verify($clave, $datos['clave']) or TRUE) {
			return $datos;
		} else {
			return FALSE;
		}
	} else {
		return FALSE;
	}
}

function eliminar_restaurante($datos)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//Buscamos si ya exite el restaurante en la base de datos.
	$preparada = $bd->prepare("SELECT CodRes from restaurantes where Correo = :correo");
	$preparada->execute($datos);
	//Si no existe, devolvemos falso.
	if ($preparada->rowCount() !== 1) {
		return false;
	} else {
		// Buscamos los datos del correo a eliminar y los guardamos en un archivo.
		$ins = "SELECT restaurantes.CodRes, restaurantes.Correo, pedidos.CodPed, pedidos.Fecha, pedidosproductos.CodProd, pedidosproductos.Unidades
	FROM restaurantes LEFT JOIN (pedidos LEFT JOIN pedidosproductos ON pedidos.CodPed = pedidosproductos.CodPed) ON restaurantes.CodRes = pedidos.Restaurante
	WHERE restaurantes.Correo = '" . $datos[':correo'] . "'";
		$resul = $bd->query($ins);
		$str_datos_a_eliminar = json_encode($resul->fetch());
		// Creamos el fichero 'copia_eliminados', abrimos con opcion 'c': si no existe, lo crea, si existe, lo abre en modo escritura.
		$fich = fopen("copia_eliminados.txt", "c");
		if ($fich === False) {
			echo "Error al crear el fichero<br>";
		} else {
			// Escribimos la información recuperada de la consulta en el fichero y comenzamos la transacción de eliminación
			fwrite($fich, $str_datos_a_eliminar);
			$bd->beginTransaction();
			//	PRIMERA ELIMINACIÓN
			$ins = "DELETE FROM pedidosproductos WHERE pedidosproductos.CodPed IN (SELECT pedidos.CodPed FROM pedidos WHERE pedidos.Restaurante IN (SELECT restaurantes.CodRes From restaurantes WHERE restaurantes.Correo = '" . $datos[':correo']  . "'))";
			$resul = $bd->query($ins);
			if (!$resul) {
				$bd->rollback();
			} else {
				//	SEGUNDA ELIMINACIÓN
				$ins = "DELETE FROM pedidos WHERE Restaurante IN (SELECT CodRes From restaurantes WHERE Correo = '" . $datos[':correo']  . "')";
				$resul = $bd->query($ins);
				if (!$resul) {
					$bd->rollback();
				} else {
					// 	TERCERA ELIMINACIÓN			
					$ins = "DELETE FROM restaurantes WHERE Correo ='" . $datos[':correo'] . "'";
					$resul = $bd->query($ins);
					if (!$resul) {
						$bd->rollback();
					} else {
						$bd->commit();
						return TRUE;
					}
					return False; // En caso de que la tercera eliminación no se haya producido
				}
				return False; // En caso de que la segunda eliminación no se haya producido
			}
			return False; // En caso de que la primera eliminación no se haya producido
		}
		return False; // En caso de que el dichero no se haya abierto bien
	}
}

function insertar_pedido($carrito, $codRes, $enviado = 0)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$bd->beginTransaction();
	$hora = date("Y-m-d H:i:s", time());
	// insertar el pedido
	$sql = "INSERT INTO pedidos(Fecha, Enviado, Restaurante) 
			VALUES('$hora', $enviado, $codRes)";
	$resul = $bd->query($sql);
	if (!$resul) {
		return FALSE;
	}
	// coger el id del nuevo pedido para las filas detalle
	$pedido = $bd->lastInsertId();
	// insertar las filas en pedidoproductos
	foreach ($carrito as $codProd => $unidades) {
		$sql = "INSERT INTO pedidosproductos(CodPed, CodProd, Unidades) 
		             VALUES( $pedido, $codProd, $unidades)";
		$resul = $bd->query($sql);
		if (!$resul) {
			$bd->rollback();
			return FALSE;
		}
	}
	$bd->commit();
	return $pedido;
}
