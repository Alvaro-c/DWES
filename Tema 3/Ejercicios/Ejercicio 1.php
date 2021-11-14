<?php

if (empty($_GET["valor1"]) || empty($_GET["valor2"])) {

    echo "Error, no has introducido los valores";

} else if (!is_numeric($_GET["valor1"]) || !is_numeric($_GET["valor2"])) {

    echo "Error, los valores introducidos no son numéricos";

} else if (is_numeric($_GET["valor1"]) || is_numeric($_GET["valor2"])) {

    echo $_GET["valor1"] + $_GET["valor2"];

} else {

    echo "Error con los parámetros introducidos";
    
}



