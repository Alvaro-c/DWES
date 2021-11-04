<?php

$num1 = 0;
$num2 = 1;
$num3 = 0;

for ($i = 0; $i < 12; $i++) {

    if ($i >= 6 && $i <= 10) {
        echo "$num1, ";
    }

    $num1 = $num1 + $num2;
    $num2 = $num3;
    $num3 = $num1;
}
