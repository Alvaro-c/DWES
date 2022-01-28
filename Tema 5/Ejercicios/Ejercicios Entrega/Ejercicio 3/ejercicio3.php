<?php

// Función del tema 4 para leer la config para conectarse a la base de datos
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

// Función del tema 4 para leer la config para conectarse a la base de datos
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

// Función que devuelve una conexión con la BBDD
function bdAux() {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    return $bd;
}

// Función que recoge los pedidos de la BBDD y los devuelve en formato JSON
function getPedidos(){
    $bd = bdAux();
    $query = "select * from pedidos;";
    $result = $bd->query($query);
    $result = $result->fetchALL(PDO::FETCH_ASSOC);
    $json = json_encode($result);

    echo $json;

}

// Llamada a la función anterior
getPedidos();