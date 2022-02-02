<?php

require 'sesiones_json.php';
require_once 'bd.php';
if (!comprobar_sesion()) return;

$restaurantes = cargar_restaurantes();
$res_json = json_encode(iterator_to_array($restaurantes));
echo $res_json;