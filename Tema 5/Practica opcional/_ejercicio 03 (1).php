<?php
$Datos = array(
    0, 0, 5, 0, 9, 5, 2, 0, 6, 4, 4, 9, 1, 0, 5, 5, 9, 2, 0, 6, 6, 6, 9, 7, 8, 2, 5, 6, 8, 7,
    7, 9, 0, 3, 0, 3, 1, 0, 4, 9, 7, 4, 3, 3, 2, 1, 4, 0, 0, 2, 4, 1, 3, 3, 4, 0, 0, 2, 0, 5,
    4, 3, 4, 2, 5, 5, 5, 0, 2, 1, 1, 5, 3, 1, 0, 5, 5, 9, 8, 7, 3, 2, 4, 2, 4, 9, 9, 1, 5, 6
);

/* Cuento el número de datos que hay en el array */
$num_datos = count($Datos);
/* echo "Número total de datos: $num_datos <br>"; */

/* Array sin ordenar */
/* foreach ($Datos as $arr) {
    echo $arr;
}
echo "<br>"; */

/* Array ordenado de menor a mayor*/
sort($Datos);
/* foreach ($Datos as $arr) {
    echo $arr;
}
echo "<br>"; */

/* Cálculo del recorrido */
echo "--- Recorrido --- <br>";
$recorrido = $Datos[$num_datos-1]-$Datos[0];
echo "El recorrido vale $recorrido <br>";

/* Cálculo de la media */
echo "<br> --- Media --- <br>";
$suma = 0;
foreach ($Datos as $arr) {
    $suma = $suma + $arr;
}
$media = $suma / $num_datos;
echo "La media vale $media <br>";

/* Cálculo de la moda */
echo "<br> --- Moda --- <br>";
// Con la función array_count_values() contamos el número de veces que aparece cada dato en el vector $Datos, es decir, la frecuencia de cada dato.
$Frecuencia = array_count_values($Datos);
print "El número de veces que aparece cada dato es: ";
echo "<pre>";
print_r($Frecuencia);
echo "</pre>";
// Ordenamos de mayor a menor el vector Frecuencia, respetando las claves
print "Las frecuencias ordenadas de mayor a menor son: ";
arsort($Frecuencia);
echo "<pre>";
print_r($Frecuencia);
echo "</pre>";

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
print_r($moda);
echo "<br>";

/* Cálculo de la mediana */
echo "<br> --- Mediana --- <br>";
if ($num_datos % 2 == 0) {
    $mediana = ($Datos[$num_datos / 2] + $Datos[($num_datos / 2) - 1]) / 2;
    echo "La mediana vale: $mediana <br>";
} else {
    $mediana = $Datos[(($num_datos + 1) / 2) - 1];
    echo "La mediana vale $mediana <br>";
}

/* Cálculo de la varianza */
echo "<br> --- Varianza --- <br>";
$suma = 0;
foreach ($Datos as $arr) {
    $suma = $suma + $arr ** 2;
}
$varianza = ($suma / $num_datos) - ($media) ** 2;
echo "La varianza vale $varianza <br>";

/* Cálculo de la desviación típica */
echo "<br> --- Desviación típica --- <br>";
$des_tip = sqrt($varianza);
echo "La desviación típica vale $des_tip <br>";

/* Cálculo de los cuartiles */
// El primer cuartil ocupa la posición (n+1)/4 
// El tercer cuartil ocupa la posición 3(n+1)/4
// Si n + 1 no es divisible por 4, entonces se toma la media de las posiciones intermedias.
// Como las claves empiezan en 0 
echo "<br> --- Cuartiles --- <br>";
if (($num_datos + 1) % 4 == 0) {
    $Q_1 = $Datos[(($num_datos + 1) / 4) - 1];
    $Q_3 = $Datos[3 * (($num_datos + 1) / 4) - 1];
} else {
    $pos_q1 = floor(($num_datos + 1) / 4);
    $pos_q3 = floor(3 * ($num_datos + 1) / 4);
    $Q_1 = ($Datos[$pos_q1] + $Datos[$pos_q1 - 1]) / 2;
    $Q_3 = ($Datos[$pos_q3] + $Datos[$pos_q3 - 1]) / 2;
}
echo "El primer cuartil vale: $Q_1 <br>";
echo "El tercer cuartil vale: $Q_3 <br>";
