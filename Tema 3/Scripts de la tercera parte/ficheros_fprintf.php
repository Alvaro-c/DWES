<?php
    $fich = fopen('fecha.txt', 'w');
    if ($fich === False){
        echo "Error al abrir o crear el fichero<br>";
    } else{
        fprintf($fich, "%04d-%02d-%02d", "1745", "1", "3");
    }