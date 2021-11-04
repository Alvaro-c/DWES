<?php

$i = 0;

function collatz($num)
{

    global $i;

    if ($num != 1 && $num % 2 == 0) {

        $i++;
        echo ("Iteracción $i, número: $num <br>");
        $num = $num / 2;

    } elseif ($num != 1 && $num % 2 != 0) {

        $i++;
        echo ("Iteracción $i, número: $num  <br>");
        $num = $num * 3 + 1;

    } elseif ($num == 1) {

        $i++;
        echo ("Iteracción $i, número: $num  <br>");
        return 1;
    }

    collatz($num);
}

collatz(10);
