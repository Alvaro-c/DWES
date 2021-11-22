<?php
function separar_por_signo($Datos)
{
    //Contamos los elementos y los separamos
    $positivos = 0;
    $negativos = 0;
    //Ya que tengo que seleccionar todos los elementos del array, utilizo para recorrerlo un foreach
    //Se podría resolver el ejercicio con solo dos arrays, el original donde dejamos los positivos y el negativo
    //Para ello, si el valor es negativo, lo guardamos en el array de negativos y lo quitamos del primer array con unset
    // Para guardar los datos en los nuevos arrays, se puede utilzar la función array_push
    foreach ($Datos as $separar) {
        if ($separar < 0) {
            $negativos++;
            $array_negativo[] = $separar;
        } else {
            $positivos++;
            $array_positivo[] = $separar;
        }
    }
    sort($array_positivo);
    asort($array_negativo);
    return array(
        "Número de positivos" => $positivos,
        "Array de positivos" => $array_positivo,
        "Negativos" => $negativos,
        "Array de negativos" => $array_negativo
    );
}

$datos = array(2, -11, 10, 0, -12, 3, -12, -1, 8, 3, 10, -11, 6, -4, -6, 3, 2, 7, 8, -11, -1, -11, -5, 12, 10, 5, 8, -7, 11, -8, 11, 3, 0, -5);
echo "<pre>";
print_r(separar_por_signo($datos));
echo "</pre>";
