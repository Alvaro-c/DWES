<?php

/*Nº3. A partir del siguiente conjunto de datos:
{0, 0, 5, 0, 9, 5, 2, 0, 6, 4, 4, 9, 1, 0, 5, 5, 9, 2, 0, 6, 6, 6, 9, 7, 8, 2, 5, 6, 8, 7,
7, 9, 0, 3, 0, 3, 1, 0, 4, 9, 7, 4, 3, 3, 2, 1, 4, 0, 0, 2, 4, 1, 3, 3, 4, 0, 0, 2, 0, 5,
4, 3, 4, 2, 5, 5, 5, 0, 2, 1, 1, 5, 3, 1, 0, 5, 5, 9, 8, 7, 3, 2, 4, 2, 4, 9, 9, 1, 5, 6}
Escribe un script que determine y muestre los siguientes parámetros estadísticos de posición, centralización y dispersión:
xRecorrido: diferencia entre el mayor y el menor, se representa por la letra R.
xMedia: se calcula mediante la siguiente fórmula:
x ̅=(∑▒x_i )/n
Es decir, la suma de todos los elementos, divida entre el número total de elementos.
Moda: El valor o los valores que más se repiten. Si hay un solo valor que sea el que más se repite, el script tiene que mostrar “conjunto unimodal”, junto con el valor que se repite y el número de repeticiones. Si hubiera más de uno, el script ha de mostrar “conjunto multimodal” junto con los valores que más se repiten y su número de repeticiones. Se representa por las letras “Mo”
Mediana: Valor que ocupa la posición central de los elementos ordenados de menor a mayor (50%) Si el número de elementos es par entonces la mediana es la media de los dos valores centrales. Se representa con las letras “Me” o “Q2”.
Varianza: se calcula mediante la siguiente fórmula:
var=(∑▒x_i^2 )/n-(x ̅ )^2
Es decir, la suma de cada uno de los elementos elevados al cuadrado, divido entre el número total de elementos, menos la media elevada al cuadrado.
Desviación típica: es la raíz cuadrada de la varianza, se representa con las letras “SD”.
Cuartil 1 y cuartil 3: al igual que la mediana, valores que ocupan las posiciones correspondientes al 25% y al 75% de los datos ordenados respectivamente. Se representan con las letras “Q1” y “Q3” */


$varianza;
$desviacion;
$cuartil1;
$cuartil3;
$min;
$max;


$sum = 0;
$totalDatos = 0;
$cero = 0;
$uno = 0;
$dos = 0;
$tres = 0;
$cuatro = 0;
$cinco = 0;
$seis = 0;
$siete = 0;
$ocho = 0;
$nueve = 0;

$countVarianza = 0;


$data = array(
    0, 0, 5, 0, 9, 5, 2, 0, 6, 4, 4, 9, 1, 0, 5, 5, 9, 2, 0, 6, 6, 6, 9, 7, 8, 2, 5, 6, 8, 7, 7, 9, 0, 3, 0,
    3, 1, 0, 4, 9, 7, 4, 3, 3, 2, 1, 4, 0, 0, 2, 4, 1, 3, 3, 4, 0, 0, 2, 0, 5, 4, 3, 4,
    2, 5, 5, 5, 0, 2, 1, 1, 5, 3, 1, 0, 5, 5, 9, 8, 7, 3, 2, 4, 2, 4, 9, 9, 1, 5, 6
);
$modaArray = array();
$arrayOrdenado = array_merge(array(), $data);
sort($arrayOrdenado);
$arraySize = count($data);


for ($i = 0; $i < count($data); $i++) {


    if ($i == 0) {

        $min = $data[$i];
        $max = $data[$i];
    }

    if ($data[$i] < $min) {

        $min = $data[$i];
    }

    if ($data[$i] > $max) {

        $max = $data[$i];
    }

    $sum = $sum + $data[$i];
    $totalDatos++;

    // Moda
    switch ($i) {

        case 0:

            $cero++;

            break;
        case 1:

            $uno++;

            break;
        case 2:

            $dos++;

            break;
        case 3:

            $tres++;

            break;
        case 4:

            $cuatro++;

            break;
        case 5:

            $cinco++;

            break;
        case 6:

            $seis++;

            break;
        case 7:

            $siete++;

            break;
        case 8:

            $ocho++;

            break;
        case 9:

            $nueve++;

            break;
    }

    // Varianza
    $countVarianza = $countVarianza + $data[$i] * $data[$i];
}

$recorrido = $max - $min;
$media = $sum / $totalDatos;
array_push($modaArray, $cero, $uno, $dos, $tres, $cuatro, $cinco, $seis, $siete, $ocho, $nueve);

$moda = max($modaArray);
$varianza = ($countVarianza / count($data)) - ($media * $media);

// mediana

function mediana($arrayOrdenado)
{

    if (count($arrayOrdenado) % 2 == 0) {

        echo ("La mediana es el número " . ($arrayOrdenado[count($arrayOrdenado) / 2 - 1]  + $arrayOrdenado[count($arrayOrdenado) / 2 + 1])/2 . ".<br>");
    } else {

        echo ("La mediana es el número " . $arrayOrdenado[count($arrayOrdenado) / 2] . ".<br>");
    }
}

function cuartil1($arrayOrdenado) {

    if ($arrayOrdenado[count($arrayOrdenado) * 0.25] % 2 == 0) {

        echo ("El cuartil 1 es ". ($arrayOrdenado[count($arrayOrdenado) * 0.25 -1] + $arrayOrdenado[count($arrayOrdenado) * 0.25 + 1]) /2 . "<br>");


    } else {

        echo ("El cuartil 1 es " . $arrayOrdenado[count($arrayOrdenado) * 0.25] . ".<br>");

    }

}

function cuartil3($arrayOrdenado) {

    if ($arrayOrdenado[count($arrayOrdenado) * 0.25] % 2 == 0) {

        echo ("El cuartil 3 es ". ($arrayOrdenado[count($arrayOrdenado) * 0.75 -1] + $arrayOrdenado[count($arrayOrdenado) * 0.75 + 1]) /2 . "<br>");


    } else {

        echo ("El cuartil 3 es " . $arrayOrdenado[count($arrayOrdenado) * 0.75] . ".<br>");

    }

}



echo ("El array tiene " . count($data) . " posiciones.<br>");
echo ("El recorrido es $recorrido .<br>");
echo ("La media es $media. <br>");
echo ("La moda es $moda. <br>");
mediana($arrayOrdenado);
echo ("La varianza es $varianza .<br>");
echo ("La desviación típica es " . sqrt($varianza))  . ".<br>";
cuartil1($arrayOrdenado);
cuartil3($arrayOrdenado);
