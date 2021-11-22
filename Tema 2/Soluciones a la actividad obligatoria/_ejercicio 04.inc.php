<?php
/* Inicializando $fact a 1 cubrimos el caso en el que $num = 0,
ya que si $num = 0 no se entra en el bucle for y $fact ya vale 1 */
function factorial($num){
    $fact = 1;
    for ($i=1;$i<=$num;$i=$i+1){
        $fact = $fact * $i;
    }
    return $fact;
}