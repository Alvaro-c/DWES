<?php
$numero = 5;
function factorial ($numero) {
    if ($numero==0) return 1;
    return $numero* factorial ($numero-1);
}
echo "El factorial de $numero es ". factorial(5);
?>