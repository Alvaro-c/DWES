<?php

function factorial($num)
{

    $resultado  = 1;

    for ($i = 1; $i <= $num; $i++) {
    
        $resultado = $resultado * $i;
    
    }
    return $resultado;

}
