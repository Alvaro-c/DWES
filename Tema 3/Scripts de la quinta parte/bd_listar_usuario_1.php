<?php
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
	echo "Conexión realizada con éxito<br>";		
	$sql = 'SELECT nombre, clave, rol FROM usuarios';
	$usuarios = $bd->query($sql);
	echo "Número de usuarios: " . $usuarios->rowCount() . "<br>";
	foreach ($usuarios as $usu) {
		print "Nombre : " . $usu['nombre'];
		print " Clave : " . $usu['clave'] . "<br>";
	}
	} catch (PDOException $e) {
		echo 'Error con la base de datos: ' . $e->getMessage();
	}