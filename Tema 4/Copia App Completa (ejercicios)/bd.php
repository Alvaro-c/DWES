<?php
function leer_config($nombre, $esquema) {
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

// Ejercicio 7 
function leer_servidor_correo($nombre, $esquema){

    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $SMTPAuth = $datos->xpath("//SMTPAuth");
    $SMTPSecure = $datos->xpath("//SMTPSecure");
    $Host = $datos->xpath("//Host");
    $Port = $datos->xpath("//Port");
    $Username = $datos->xpath("//Username");
    $Password = $datos->xpath("//Password");

    // Monto array con la config
    $resul = [];
    $resul[] = $SMTPAuth[0];
    $resul[] = $SMTPSecure[0];
    $resul[] = $Host[0];
    $resul[] = $Port[0];
    $resul[] = $Username[0];
    $resul[] = $Password[0];
    return $resul;

}

// Ejercicio 3
// Ejercicio 4
function actualizar_restaurante($datos) {

    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);

    $preparada = $bd->prepare("UPDATE restaurantes SET 
    Correo = :correo, 
    Clave = :clave, 
    Pais = :pais, 
    Cp = :cp, 
    Ciudad = :ciudad, 
    Direccion = :direccion, 
    Rol = :rol 
    WHERE CodRes = :codres;");
    // Ejercicio 4
    $datos[':clave'] = password_hash($datos[':clave'], PASSWORD_BCRYPT);
    // Ejercicio 3
    $resul = $preparada->execute($datos); // El array $datos debe tener el mismo número de claves que los parametros a sustituir en la consulta

    return $resul;
}

function comprobar_usuario($nombre, $clave) {
    // dirname rescata la ruta donde está situado el script
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    // Ejercicio 2: 
    // recoger el Rol de la BBDD
    // Ejercicio 4
    // Ejercicio 5
    // Ejercicio 9
    // Opción 1: por posición
    $datos[] = $nombre;
    $preparada = $bd->prepare("select codRes, correo, rol, clave from restaurantes where correo = ?");
    // Opción 2: por nombre
    // $datos[':nombre'] = $nombre;
    // $preparada = $bd->prepare("select codRes, correo, rol, clave from restaurantes where correo = :nombre");
    
    $preparada->execute($datos);

    if ($preparada->rowCount() === 1) {

        $datos = $preparada->fetch();
        if (password_verify($clave, $datos['clave'])) {

            return $datos;
        }
        return false;
    } else {
        return FALSE;
    }
}

function cargar_categorias() {
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
    // Esto devuelve un PDO
    return $resul;
}

function cargar_categoria($codCat) {
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
    // Esto devuelve un array
    return $resul->fetch();
}

function cargar_productos_categoria($codCat) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    // Ejercicio 5
    $sql = "select * from productos where Codcat  = $codCat and stock > 0";
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
function cargar_productos($codigosProductos) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    // transformo un array en un string y separo las keys por comas
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

function cargar_restaurantes() {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) .
        "/configuracion.xsd");
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


function insertar_pedido($carrito, $codRes) {
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
