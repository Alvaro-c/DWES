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

function leer_servidor($nombre, $esquema) {
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

function leer_cookie($nombre_cookie, $valor_por_defecto = FALSE) {
    if (!isset($_COOKIE[$nombre_cookie])) {
        return $valor_por_defecto;
    } else {
        return $_COOKIE[$nombre_cookie];
    }
}

// función para ahorrar un poco de código repetido en el resto de funciones
// Abre la conexión con la bd y la devuelve
function bdAux() {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    return $bd;
}

// Funcion que actualiza la categoría modificada en el formulario
function actualizar_categoria($datos) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    unset($datos['Modificar']);
    $preparada = $bd->prepare("UPDATE categorias SET 
	nombre = :nombre,
	descripcion = :descripcion,
    Descatalogado = :catalogo
	WHERE CodCat = :CodCat");
    $resul = $preparada->execute($datos);
    return $resul;
}

// Funcion que actualiza el producto modificado en el formulario
function actualizar_producto($datos) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    unset($datos['Modificar']);
    $preparada = $bd->prepare("UPDATE productos SET 
	nombre = :nombre,
	descripcion = :descripcion,
    peso = :peso,
    stock = :stock,
    Descatalogado = :catalogo,
    CodCat = :CodCat
	WHERE CodProd = :CodProd");
    $resul = $preparada->execute($datos);
    return $resul;
}


function actualizar_restaurante($datos) {
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

function actualizar_clave($datos) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $preparada = $bd->prepare("UPDATE restaurantes SET
	Clave = :clave,
	Correo = :correo 
	WHERE CodRes = :codres");
    $datos[':clave'] = password_hash($datos[':clave'], PASSWORD_BCRYPT);
    $resul = $preparada->execute($datos);
    return $resul;
}

// Actualiza los envíos pendientes siempre que no haya que eliminarlo
// Si el envío pendiente se elimina, se utiliza otra función
function actualizar_pendientes($CodProd, $CodPed, $UdPend) {
    $bd = bdAux();
    $query = "Update productospendientes set UdPend = $UdPend where CodProd = $CodProd and CodPed = $CodPed;";
    $bd->query($query);

}

// Añadir una categoría
function alta_categoria($datos) {
    $bd = bdAux();
    unset($datos[':agregar']);
    $preparada = $bd->prepare("Insert into categorias values (default, :nombre, :descripcion, :catalogo)");
    $resul = $preparada->execute($datos);
    return $resul;

}

// Añadir un producto
function alta_producto($datos) {
    $bd = bdAux();
    unset($datos[':agregar']);
    // en la consulta, :CodProd tendá valor "default" que viene del formulario de submit
    $preparada = $bd->prepare("Insert into productos values (
    :CodProd, :nombre, :descripcion, :peso, :stock, default, :CodCat)");
    $resul = $preparada->execute($datos);
    return $resul;

}

function alta_restaurante($datos) {
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

function cargar_categorias() {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $aux = leer_cookie('descatalogado', 0);
    if ($aux != 1) {
        $ins = "SELECT CodCat, Nombre, Descripcion, Descatalogado FROM categorias where Descatalogado = $aux";
    } else {
        $ins = "SELECT CodCat, Nombre, Descripcion, Descatalogado FROM categorias";
    }
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

function cargar_categoria($codCat) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $ins = "SELECT Nombre, Descripcion, Descatalogado FROM categorias WHERE Codcat = $codCat";
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

function cargar_productos_categoria($codCat) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    // El valor de $aux corresponde a la cookie de descatalogados
    $aux = leer_cookie('descatalogado', 0);
    // Dependiendo de si se quieren ver los productos descatalogados se ejecuta una consulta u otra
    if ($aux != 1) {
        $sql = "SELECT * FROM productos WHERE Codcat  = $codCat AND Descatalogado = $aux AND Stock >= " . leer_cookie('stock', 0);
    } else {
        $sql = "SELECT * FROM productos WHERE Codcat  = $codCat AND Stock >= " . leer_cookie('stock', 0);
    }
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

// Esta función hace lo mismo que la anterior, pero muestra una categoría sin prodcutos en lugar de arrojar un error
// Es sólo para los gestores de produtos
function cargar_productos_categoria_gestion($codCat) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $aux = leer_cookie('descatalogado', 0);
    if ($aux != 1) {
        $sql = "SELECT * FROM productos WHERE Codcat  = $codCat AND Descatalogado = $aux AND Stock >= " . leer_cookie('stock', 0);
    } else {
        $sql = "SELECT * FROM productos WHERE Codcat  = $codCat AND Stock >= " . leer_cookie('stock', 0);
    }
    $resul = $bd->query($sql);
    if (!$resul) {
        return FALSE;
    }
    //if ($resul->rowCount() === 0) {
    //    return FALSE;
    //}
    //si hay 1 o más
    return $resul;
}

// Esta función es similar a la anterior, pero es necesaria para mostrar todos los productos juntos (opción que no tienen los users)
function cargar_productos_categoria_gestion_descat($codCat) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $aux = leer_cookie('descatalogado', 0);
    $sql = "SELECT * FROM productos WHERE Descatalogado = $aux AND Stock >= " . leer_cookie('stock', 0);
    $resul = $bd->query($sql);
    if (!$resul) {
        return FALSE;
    }
    //if ($resul->rowCount() === 0) {
    //    return FALSE;
    //}
    //si hay 1 o más
    return $resul;
}

// recibe un array de códigos de productos
// devuelve un cursor con los datos de esos productos
function cargar_productos($codigosProductos) {
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

function cargar_productos_pendientes() {
    $bd = bdAux();

    // Esta consulta carga los productos pendientes además de los datos requeridos por el programa
    $ins = "select restaurantes.CodRes, restaurantes.Correo, p2.CodPed, p.Fecha, p2.CodProd, p3.Nombre, p2.UdPend
    from restaurantes join pedidos p on restaurantes.CodRes = p.Restaurante
    join productospendientes p2 on p.CodPed = p2.CodPed join productos p3 on p2.CodProd = p3.CodProd;";
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

function cargar_restaurantes() {
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

// Función que carga los productos que no tienen stock, antes de procesar el carrito
function cargar_sin_stock($faltan) {

    $productos = cargar_productos(array_keys($faltan));

    echo "<h2>Faltan los siguientes productos</h2>";
    echo "<table>"; //abrir la tabla
    echo "<tr><th>Ud pedidas</th><th>Ud que faltan</th><th>Nombre</th><th>Descripción</th><th>Categoría</th></tr>";
    foreach ($productos as $producto) {
        $cod = $producto['CodProd'];
        $nom = $producto['Nombre'];
        $des = $producto['Descripcion'];
        $categoria = get_categoria($producto['CodCat']);
        $udPedidas = $_SESSION['carrito'][$cod];
        $udFaltan = $faltan[$cod];
        $unidadesDispo = $producto['Stock'];

        echo "<tr><td>$udPedidas</td><td>$udFaltan</td><td>$nom</td><td>$des</td><td>$categoria</td>";
    };

    echo "</tr></table>";
    echo "<form action='procesar_pedido.php' method='post'><input type='submit' class='boton'  name='tramitar' value='Tramitar pedido'></form>";


}

// Esta función se ejecuta cuando se cambia el valor de algún producto pendiente
// Comprueba los pedidos con valor Enviado = 1 y si ya no tienen prod. pendientes, los cambia a Enviado = 0
function comprobar_pedidos_pendientes($CodPed) {
    $bd = bdAux();
    // Compruebo si quedan productos pendientes en el pedido actualizado
    $query = "select * from productospendientes where CodPed = $CodPed;";
    $result = $bd->query($query);
    // Si hay resultados no hago nada porque aún hay productos pendientes
    if ($result->rowCount() > 0) {
        return true;
    } else {
        // Si no hay resultados, el pedido ya no tiene productos pendientes, se actualiza el campo enviado a 0
        $query = "UPDATE pedidos.pedidos t SET t.Enviado = 0 WHERE t.CodPed = $CodPed;";
        $result = $bd->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }


}

// Esta función es llamada cuando un producto ya no está pendiente.
// Borra el producto de la tabla y comprueba si el pedido se puede actualizar a Enviado = 0
function comprobar_pendientes($CodProd, $CodPed) {

    $bd = bdAux();
    // Se elimina el producto de la tabla productos pendientes
    $query = "delete from productospendientes where CodProd = $CodProd and CodPed = $CodPed;";
    $bd->query($query);
    // Se comprueba si los pedidos con Enviado = 1 tienen productos pendientes
    comprobar_pedidos_pendientes($CodPed);

}

function comprobar_usuario($nombre, $clave) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    //$preparada = $bd->prepare("SELECT codRes, correo, rol, clave from restaurantes where correo = :nombre");
    //$preparada->execute(array(':nombre' => $nombre));
    $preparada = $bd->prepare("SELECT CodRes, Correo, Rol, Clave from restaurantes where Correo = ?");
    $preparada->execute(array($nombre));
    if ($preparada->rowCount() === 1) {
        $datos = $preparada->fetch();
        if (password_verify($clave, $datos['Clave'])) {
            return $datos;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

// Función para transformar una consulta en formato carrito CodProd:cantidad
function consulta_a_carrito($array) {

    $carrito = array();

    for ($i = 0; $i < count($array); $i++) {
        $carrito[$array[$i]['CodProd']] = $array[$i]['Stock'];
    }
    return $carrito;

}

function eliminar_restaurante($datos) {
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
            $ins = "DELETE FROM pedidosproductos WHERE pedidosproductos.CodPed IN (SELECT pedidos.CodPed FROM pedidos WHERE pedidos.Restaurante IN (SELECT restaurantes.CodRes From restaurantes WHERE restaurantes.Correo = '" . $datos[':correo'] . "'))";
            $resul = $bd->query($ins);
            if (!$resul) {
                $bd->rollback();
            } else {
                //	SEGUNDA ELIMINACIÓN
                $ins = "DELETE FROM pedidos WHERE Restaurante IN (SELECT CodRes From restaurantes WHERE Correo = '" . $datos[':correo'] . "')";
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


// Función para eliminar una categoría. Funciona con una transacción
function eliminar_categorias($codCat) {

    $bd = bdAux();
    $datos = array(':codCat' => $codCat);
    // busco si existe la categoría
    $preparada = $bd->prepare("SELECT CodCat from categorias where CodCat = :codCat");
    $preparada->execute($datos);
    //Si no existe, devolvemos falso.
    if ($preparada->rowCount() !== 1) {
        return false;
    } else {
        // comienzo la transaccion
        $bd->beginTransaction();
        // Si existe, busco los codigos de productos de los productos de la categoría
        $productos = cargar_productos_categoria($codCat);

        // Elimino cada producto o lo descatalogo, con la funcion eliminar productos
        foreach ($productos as $producto) {
            $cod = $producto['CodProd'];
            if (!eliminar_productos($cod)) {
                $bd->rollback();
                return false;
            }
        }
        $bd->commit();
        return true;
    }
}

// Esta función elimina productos si no están en la tabla pedidosproductos o productos pendientes
// Si están en alguna de esas dos tablas, los descataloga
function eliminar_productos($codProd) {
    $bd = bdAux();
    $datos = array(':codProd' => $codProd);
    // busco si existe el producto
    $preparada = $bd->prepare("SELECT CodProd from productos where CodProd = :codProd");
    $preparada->execute($datos);
    //Si no existe, devolvemos falso.
    if ($preparada->rowCount() !== 1) {
        return false;
    } else {
        // Compruebo si el producto está en las tablas pedidosproductos o en productospendientes
        // pedidosproductos
        $preparada = $bd->prepare("select p.CodProd 
        from productos p join pedidosproductos p2 on p.CodProd = p2.CodProd where p.CodProd = :codProd");
        $preparada->execute($datos);
        $pedidosproductos = $preparada->rowCount();

        //productospendientes
        $preparada = $bd->prepare("select p.CodProd 
        from pedidos.productos p join pedidos.productospendientes p2 on p.CodProd = p2.CodProd where p.CodProd = :codProd");
        $preparada->execute($datos);
        $productospendientes = $preparada->rowCount();


        // en caso de que el producto esté en alguna de las dos tablas, se descataloga
        if ($pedidosproductos != 0 || $productospendientes != 0) {
            $preparada = $bd->prepare("UPDATE pedidos.productos t
            SET t.Descatalogado = 1
            WHERE t.CodProd = :codProd;");
            $preparada->execute($datos);
            return true;

        } else {
            // en caso contrario (no está en esas tablas) se elimina definitivamente
            $preparada = $bd->prepare("DELETE
            FROM pedidos.productos
            WHERE CodProd = :codProd;");
            $preparada->execute($datos);
            return true;

        }

    }

}


// Esta función exporta los productos de los envíos pendientes a un txt
function exportar_txt($datos) {

    $fich = fopen('envios_pendientes.txt', 'w');
    if ($fich === False) {
        echo "Error al abrir o crear el fichero<br>";
    } else {

        foreach ($datos as $producto) {
            $CodRes = $producto['CodRes'];
            $Correo = $producto['Correo'];
            $CodPed = $producto['CodPed'];
            $Fecha = $producto['Fecha'];
            $CodProd = $producto['CodProd'];
            $Nombre = $producto['Nombre'];
            $UdPend = $producto['UdPend'];

            fprintf($fich, "%s; %s; %s; %s; %s; %s; %s", $CodRes, $Correo, $CodPed, $Fecha, $CodProd, $Nombre, $UdPend);
            fprintf($fich, "%s", "\n");

        }


    }


}


// Compruebo si falta stock de algún producto antes de dar el producto por tramitado

function falta_stock($carrito) {

    //Recupero las claves de todos los productos que deberían estar en el carrito
    $keys = implode(",", array_keys($carrito));
    $sql = "Select CodProd, Stock from productos where CodProd in ($keys)";
    // Consulto la BBDD y obtengo un array con los productos que faltan y el stock que hay
    $arrayProductos = select($sql);
    $arrayProductos = consulta_a_carrito($arrayProductos);
    $faltan = array();

    // Bucles for para encontrar los productos que faltan
    // Crea el array faltan con los codigos y unidades que faltan
    foreach ($carrito as $codProdCarr => $unidades) {
        foreach ($arrayProductos as $codProdBD => $unidadesBD) {

            if ($codProdCarr == $codProdBD && $unidades > $unidadesBD) {
                $faltan[$codProdBD] = $unidades - $unidadesBD;
            }
        }
    }

    if (count($faltan) > 0) {
        return $faltan;
    } else {
        return false;
    }


}

// Función que devuelve el nombre de una categoría buscando por su código
function get_categoria($codigo) {

    $sql = "Select nombre from categorias where CodCat = $codigo";
    $resultado = select($sql);
    return $resultado[0]['nombre'];

}

function insertar_pedido($carrito, $codRes, $enviado = 0) {
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

// esta función añade los productos sin stock de un pedido a la tabla correspondiente.
// Recibe un array similar al carrito, pero sólo de productos que no tienen stock. También recibe el número del último pedido
function insertar_sin_stock($envio_pendiente, $pedido) {

    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $bd->beginTransaction();

    foreach ($envio_pendiente as $codProd => $unidades) {
        $sql = "INSERT INTO productospendientes
		             VALUES( default, $pedido, $codProd, $unidades)";
        $resul = $bd->query($sql);
        if (!$resul) {
            $bd->rollback();
            return FALSE;
        }
    }

    $bd->commit();

}


// Ejecuta cierta sentencia select $sql y devuelve un array con los resultados
function select($sql) {

    // Conexión con la base de datos
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    // Declaración del array que se va a devolver
    $array = array();
    //Consulta
    $resultado = $bd->query($sql);
    $array = $resultado->fetchAll(PDO::FETCH_ASSOC);

    return $array;
}