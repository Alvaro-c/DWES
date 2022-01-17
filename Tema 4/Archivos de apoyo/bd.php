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
function leer_cookie($nombre_cookie, $valor_por_defecto = FALSE){
	if (!isset($_COOKIE[$nombre_cookie])){
		return $valor_por_defecto;
	}else{
	  	return $_COOKIE[$nombre_cookie];
	}
}


function actualizar_restaurante($datos){
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

function actualizar_clave($datos){
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
function alta_restaurante($datos){
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//Buscamos si ya exite el restaurante en la base de datos.
	$preparada = $bd->prepare("SELECT codRes, correo, rol, clave from restaurantes where correo = ?");
	$preparada->execute(array($datos[0]));
	//Si existe, devolvemos falso.
	if ($preparada->rowCount() === 1) {
		return false;
	}else{
	// en caso contrario, preparamos la consulta, hasheamos la contraseña y lo guardamos en la base de datos.
		$preparada = $bd->prepare("INSERT INTO restaurantes (Correo, Clave, Rol) VALUES (?,?,?)");
		$datos[1]= password_hash($datos[1], PASSWORD_BCRYPT);
		$resul = $preparada->execute($datos);
	}
	return $resul;
}
function eliminar_restaurante($datos){
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//Buscamos si ya exite el restaurante en la base de datos.
	$preparada = $bd->prepare("SELECT codRes from restaurantes where correo = :correo");
	$preparada->execute($datos);
	//Si no existe, devolvemos falso.
	if ($preparada->rowCount() !== 1) {
		return false;
	}else{
		
	/*
	Buscamos los datos del correo a eliminar:
	
	"SELECT restaurantes.CodRes, restaurantes.Correo, pedidos.CodPed, pedidos.Fecha, pedidosproductos.CodProd, pedidosproductos.Unidades
	FROM restaurantes LEFT JOIN (pedidos LEFT JOIN pedidosproductos ON pedidos.CodPed = pedidosproductos.CodPed) ON restaurantes.CodRes = pedidos.Restaurante
	WHERE restaurantes.Correo= madrid1@empresa.com"

	CREACIÓN DEL FICHERO
		$fich = fopen ("copia_eliminados.txt","c");
		fwrite($fich, datos_de_la_consulta)
		Si se ha creado y guardado bien la información
		$bd->beginTransaction();
			PRIMERA ELIMINACIÓN
			$ins = "DELETE * FROM pedidosproductos WHERE CodPed IN (SELECT CodPEd FROM pedidos WHERE Restaurante IN (SELECT CorRes From restaurantes WHERE Correo= madrid1@empresa.com"))
			$resul = $bd->query($ins);
		 	 	Si ha ido bien
					SEGUNDA ELIMINACIÓN
					$ins = "DELETE * FROM pedidos WHERE Restaurante IN (SELECT CorRes From restaurantes WHERE Correo= madrid1@empresa.com"))
			 	 	$resul = $bd->query($ins);	
						Si ha ido bien
							TERCERA ELIMINACIÓN
							$ins = "DELETE * FROM restaurantes WHERE Correo= madrid1@empresa.com"))
							$resul = $bd->query($ins);
				 				Si ha ido bien
				 					$bd->commit();
				 				Si la tercera no ha ido bien
				 					$bd->rollback();
						Si la segunda no ha ido bien
							$bd->rollback();
				Si la primera no ido bien
					$bd->rollback();
		Si no se ha creado bien
		return FALSE;	
	*/			
	return TRUE;
	}
}

function comprobar_usuario($nombre, $clave)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//$preparada = $bd->prepare("SELECT codRes, correo, rol, clave from restaurantes where correo = :nombre");
	//$preparada->execute(array(':nombre' => $nombre));
	$preparada = $bd->prepare("SELECT codRes, correo, rol, clave from restaurantes where correo = ?");
	$preparada->execute(array($nombre));
	if ($preparada->rowCount() === 1) {
		$datos =  $preparada->fetch();
			if (password_verify($clave, $datos['clave']) OR TRUE){
				return $datos;
			}else{
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
	$ins = "select codCat, nombre from categorias";
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
	$ins = "select nombre, descripcion from categorias where codcat = $codCat";
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
	$sql = "select * from productos where Codcat  = $codCat AND stock >= ". leer_cookie('stock',0);
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
		$ins = "select * from productos where codProd in($texto_in)";
		$resul = $bd->query($ins);
		if (!$resul) {
			return FALSE;
		}
		return $resul;
	}
}
function cargar_restaurantes()
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$ins = "select * from restaurantes";
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

	

function insertar_pedido($carrito, $codRes)
{
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	$bd->beginTransaction();
	$hora = date("Y-m-d H:i:s", time());
	// insertar el pedido
	$sql = "insert into pedidos(fecha, enviado, restaurante) 
			values('$hora',0, $codRes)";
	$resul = $bd->query($sql);
	if (!$resul) {
		return FALSE;
	}
	// coger el id del nuevo pedido para las filas detalle
	$pedido = $bd->lastInsertId();
	// insertar las filas en pedidoproductos
	foreach ($carrito as $codProd => $unidades) {
		$sql = "insert into pedidosproductos(CodPed, CodProd, Unidades) 
		             values( $pedido, $codProd, $unidades)";
		$resul = $bd->query($sql);
		if (!$resul) {
			$bd->rollback();
			return FALSE;
		}
	}
	$bd->commit();
	return $pedido;
}
