<?php
// Este script es una modificación del script de la unidad 2. 
// La lógica es la misma, sólo se recoge la información relevante del POST y se devuelve el resultado.

// For testing purposes: 1,1,1,1,1,1,1,1,0,0,5,0,9,5,2,0,6,4,4,9,1,0,5,5,9,2,0,6,6,6,9,7,8,2,5,6,8,7,7,9,0,3,0,3,1,0,4,9,7,4,3,3,2,1,4,0,0,2,4,1,3,3,4,0,0,2,0,5,4,3,4,2,5,5,5,0,2,1,1,5,3,1,0,5,5,9,8,7,3,2,4,2,4,9,9,1,5,6

$Datos = array($_POST['array']);
$Datos = explode(',', $Datos[0]);
$operacion = $_POST['operacion'];

$num_datos = count($Datos);
/* Cálculo del recorrido */
if ($operacion == 'recorrido') {

    $recorrido = $Datos[$num_datos - 1] - $Datos[0];
    echo $recorrido;
} else if ($operacion == 'media') {

    $suma = 0;
    foreach ($Datos as $arr) {
        $suma = $suma + $arr;
    }
    $media = $suma / $num_datos;
    echo $media;
} else if ($operacion == 'moda') {
    /* Cálculo de la moda */
    // Con la función array_count_values() contamos el número de veces que aparece cada dato en el vector $Datos, es decir, la frecuencia de cada dato.
    $Frecuencia = array_count_values($Datos);
    arsort($Frecuencia);
    // Buscamos los elementos com mayor frecuencia
    // Tomo la frecuencia y el dato de la primera posición y lo guardo en el vector $moda
    $mayor = Current($Frecuencia);
    $moda[key($Frecuencia)] = $mayor;
    // Avanzao en el vector $Frecuencia, si el siguiente vale tanto como el primero, entonces lo añado al vector moda.
    while ($mayor == next($Frecuencia)) {

        $mayor = Current($Frecuencia);
        $moda[key($Frecuencia)] = $mayor;
    }

    if (count($moda) == 1) {
        echo "Conjunto unimodal: ";
    } else {
        echo "Conjunto multimodal: ";
    }
    foreach($moda as $num => $reps) {
        echo "El número $num se repite $reps veces; ";
    }
    //print_r($moda);


} else if ($operacion == 'varianza') {
    $suma = 0;
    foreach ($Datos as $arr) {
        $suma = $suma + $arr;
    }
    $media = $suma / $num_datos;
    $suma = 0;
    foreach ($Datos as $arr) {
        $suma = $suma + $arr ** 2;
    }
    $varianza = ($suma / $num_datos) - ($media) ** 2;
    echo $varianza;
} else if ($operacion == 'desviacion') {

    $suma = 0;
    foreach ($Datos as $arr) {
        $suma = $suma + $arr;
    }
    $media = $suma / $num_datos;
    $suma = 0;
    foreach ($Datos as $arr) {
        $suma = $suma + $arr ** 2;
    }
    $varianza = ($suma / $num_datos) - ($media) ** 2;
    echo $varianza;

    $des_tip = sqrt($varianza);
    echo $des_tip;
} else if ($operacion == 'cuartiles') {

    if (($num_datos + 1) % 4 == 0) {
        $Q_1 = $Datos[(($num_datos + 1) / 4) - 1];
        $Q_3 = $Datos[3 * (($num_datos + 1) / 4) - 1];
    } else {
        $pos_q1 = floor(($num_datos + 1) / 4);
        $pos_q3 = floor(3 * ($num_datos + 1) / 4);
        $Q_1 = ($Datos[$pos_q1] + $Datos[$pos_q1 - 1]) / 2;
        $Q_3 = ($Datos[$pos_q3] + $Datos[$pos_q3 - 1]) / 2;
    }
    echo "El primer cuartil vale: $Q_1 ; El tercer cuartil vale: $Q_3 ";
}
