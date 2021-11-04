<?php
$transporte = array('A pie', 'Bicicleta', 'Coche', 'Avión');
print_r($transporte). "<br>";
$modo = current($transporte); // $modo = 'A pie';
print "<br>Posición actual (current): ". key($transporte). "; Valor: $modo <br>";
$modo = next($transporte);    // $modo = 'Bicicleta';
print "Posición siguente (next): ". key($transporte). "; Valor: $modo <br>";
$modo = current($transporte); // $modo = 'Bicicleta';
print "Posición actual (current): ". key($transporte). "; Valor: $modo <br>";
$modo = prev($transporte);    // $modo = 'A pie';
print "Posición anterior (prev): ". key($transporte). "; Valor: $modo <br>";
$modo = end($transporte);     // $modo = 'Avión';
print "Posición final (end): ". key($transporte). "; Valor: $modo <br>";
$modo = reset($transporte); // $modo = 'Avión';
print "Posición inicial (reset): ". key($transporte). "; Valor: $modo <br>";