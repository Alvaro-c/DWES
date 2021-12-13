<?php
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    echo 'Conectado';
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
} 