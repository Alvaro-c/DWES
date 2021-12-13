<?php
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
	echo "Conexión realizada con éxito<br>";
	// comenzar la transacción
	$bd->beginTransaction();	
	$ins = "insert into usuarios(nombre, clave, rol) values('Fernando', '33333', '1')";
	$resul = $bd->query($ins);	
	// se repite la consulta
	// falla porque el nombre es unique
	$resul = $bd->query($ins);	
	if(!$resul){
		echo "Error: " . print_r($bd->errorinfo());
		// deshace el primer cambio
		$bd->rollback();
		echo "<br>Transacción anulada<br>";
	}else{
		// si hubiera ido bien...
		$bd->commit();
	}	
} catch (PDOException $e) {
    echo 'Error al conectar: ' . $e->getMessage();
} 