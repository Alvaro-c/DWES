<?php
function segundo_grado($a, $b, $c){
    $discriminante = (($b**2)-4*$a*$c);
    if ($discriminante>=0){
        if ($discriminante == 0) {
            $x= -$b/(2*$a);
            $Soluciones = array($x);
            echo $a. "x<sup>2</sup> + ". $b ."x + $c tiene una única solución doble: $x <br>";
        }else{
            $x_1 = (-$b+sqrt($discriminante))/(2*$a);
            $x_2 = (-$b-sqrt($discriminante))/(2*$a);
            $Soluciones = array($x_1,$x_2);
            echo $a. "x<sup>2</sup> + ". $b ."x + $c tiene dos soluciones: $x_1 y $x_2 <br>";
        }
        return $Soluciones;
    } else {
        return $a. "x<sup>2</sup> + ". $b ."x + $c no tiene solución <br>";
    }
}

$a = 1;
$b = 0;
$c = -1;
echo segundo_grado($a, $b, $c);

$a = 1;
$b = 0;
$c = 1;
echo segundo_grado($a, $b, $c);

$a = 1;
$b = 2;
$c = 1;
echo segundo_grado($a, $b, $c);

