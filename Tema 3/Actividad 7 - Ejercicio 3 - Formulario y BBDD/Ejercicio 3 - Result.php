<?php

$conReq = 'mysql:dbname=empresa;host=127.0.0.1';
$user = "root";
$pass = "";

try {

    $bd = new PDO($conReq, $user, $pass);
    $codigo = $_GET["codigo"];
    $sql = "SELECT * FROM usuarios WHERE codigo = $codigo";
    $usuarios = $bd->query($sql);

    $arr= $usuarios->fetchAll();

    $codQ = $arr[0][0];
    $nomQ = $arr[0][1];
    $claQ = $arr[0][2];
    $rolQ = $arr[0][3];

    echo nl2br("Código: $codQ;\n Nombre: $nomQ;\n Clave: $claQ;\n Rol: $rolQ \n");


} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}