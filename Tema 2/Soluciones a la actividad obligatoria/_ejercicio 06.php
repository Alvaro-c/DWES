<?php
function limitar($Datos, $limite)
{
    // Ordenamos de menor a mayor el vector Datos respetando las claves
    asort($Datos);
    // Tomo el primer valor y la primera clave.
    $valor = Current($Datos);
    $clave = key($Datos);
    // Mientras el valor sea menor que el límite, lo guardo en el vector resultante ($array_limitado)
    // También se pueden eliminar los valores mayores con unset o utilizar la función array_dif para ir sacando los mayores
    while ($valor < $limite) {
        $array_limitado[$clave] = $valor;
        $valor = next($Datos);
        $clave = key($Datos);
    }
    return $array_limitado;
}
$datos = array(2, 11, 10, 0, 12, 3, 12, 1, 8, 3, 10, 11, 6, 4, 6, 3, 2, 7, 8, 11, 1, 11, 5, 12, 10, 5, 8, 7, 11 ,8 ,11 ,3 , 0, 5);
echo "<pre>";
print_r(limitar($datos,11));
echo "</pre>";
