<?php
/*
La sucesión de fibonacci es: 0 1 1 2 3 5 8 13 21 34 55 89 144
El término 7 es: 13
El término 11 es: 89
*/

/* Solución mediante función recursiva sacada de internet */
function fibonacci_r($n)
{
    if ($n == 0) {
        return 0;
    }
    if ($n == 1) {
        return 1;
    }
    if ($n > 1) {
        return fibonacci_r($n - 1) +  fibonacci_r($n - 2);
    }
}
/* Solución mediante función iterativa */
function fibonacci_w($n)
{
    if ($n == 0) {
        return 0;
    }
    if ($n == 1) {
        return 1;
    }
    if ($n > 1) {
        $a_0 = 0;
        $a_1 = 1;
        for ($i = 2; $i <= $n; $i++) {
            $a_n = $a_0 + $a_1;
            $a_0 = $a_1;
            $a_1 = $a_n;
        }
        return $a_n;
    }
}
echo "Recursivamente, el termino 7 es: " . fibonacci_r(7) . "<br>";
echo "Iterativamente, el termino 7 es: " . fibonacci_w(7) . "<br>";
echo "Recursivamente, el termnio 11 es: " . fibonacci_r(11) . "<br>";
echo "Iterativamente, el termnio 11 es: " . fibonacci_w(11) . "<br>";
