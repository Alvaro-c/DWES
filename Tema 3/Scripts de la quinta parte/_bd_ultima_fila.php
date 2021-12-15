<?php
// datos conexión
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try {
	// conectar
    $bd = new PDO($cadena_conexion, $usuario, $clave);	
	echo "Conexión realizada con éxito.<br>";
	echo "Truncamos la tabla usuarios.<br>";
	echo "<br>";
	// Trucamos la tabla
	$bd->query("TRUNCATE usuarios");	
	// insertar solo un nuevo usario
	$ins = "INSERT INTO usuarios(nombre, clave, rol) VALUES ('Ana', '11111', '0'),('Sofia', '22222', '0'),('Rosa', '33333', '0')";
	$resul = $bd->query($ins);	
	//comprobar errores
	if($resul) {
		echo "[1] Insertamos tres usuarios<br>";
		echo " · Filas insertadas: " . $resul->rowCount() . "<br>";
		// para los autoincrementos
		echo " · Código de la fila insertada: " . $bd->lastInsertId() . "<br>"; 
	}else print_r( $bd -> errorinfo());
	echo "<br>";
	// insertar varios nuevos usarios
	$ins = "INSERT INTO usuarios(nombre, clave, rol) VALUES ('Carmen', '44444', '0'),('Cristina', '55555', '0')";
	$resul = $bd->query($ins);	
	//comprobar errores
	if($resul) {
		echo "[2] Insertamos dos usuarios<br>";
		echo " · Filas insertadas: " . $resul->rowCount() . "<br>";
	// para los autoincrementos
	echo " · Código de la fila insertada: " . $bd->lastInsertId() . "<br>"; 
	}else print_r( $bd -> errorinfo());	
} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
} 
