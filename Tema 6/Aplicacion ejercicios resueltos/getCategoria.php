<?php
require_once 'bd.php';
/*comprueba que el usuario haya abierto sesión o devuelve*/
require 'sesiones_json.php';
if (!comprobar_sesion()) return;
$productos_array = [];
$categoria = getCategoria($_GET['CodProd']);
$resul = iterator_to_array($categoria);
$cat_json = json_encode($resul);

echo $cat_json;
