<?php


function correos($fullName, $dni, &$correos)
{
    // get dni without letter
    $dniClave = substr($dni, 0, strlen($dni) - 1);


    // get email
    // pass name to lower case
    $fullName = strtolower($fullName);

    // set an empty string to built the email
    $newCorreo = "";

    // split name and surname in different arrays
    $fullNameArray = explode(",", $fullName);
    $name = $fullNameArray[1];
    $nameArray = explode(" ", $name);


    // check if the name is composed
    if (count($nameArray) > 1) {

        // if composed, split in arrays and get the first letter of middle names to be attached to the first name
        $newName = "";
        $newName = $newName . $nameArray[1];

        for ($i = 2; $i < count($nameArray); $i++) {

            $newName = $newName . substr($nameArray[$i], 0, 1);
        }
    } else {
        // not composed name, just get the name

        $newName = $fullNameArray[0];
    }

    // split the surnames
    $surnames = $fullNameArray[0];
    $surnamesArray = explode(" ", $surnames);

    // putting together name and first 3 letters of surnames
    $newCorreo = $newCorreo . $newName . ".";
    $newCorreo = $newCorreo . substr($surnamesArray[0], 0, 3) . substr($surnamesArray[1], 0, 3);

    // check if newCorreo already exists
    $newCorreo = compruebaCorreo($newCorreo, $correos);

    // adding the domain once checked it is not duplicated
    $newCorreo = $newCorreo . "@dwes.es";

    // adding key and value to the array
    $correos[$dniClave] = $newCorreo;
}


function compruebaCorreo($newCorreo, $correos)
{

    $i = 0;

    // check if the mail has been taken before
    foreach ($correos as $correo) {

        // delete @dwes.es
        $correo = substr($correo, 0, strlen($correo) - 8);

        // get possible dupes
        $correo = substr($correo, 0, strlen($newCorreo));

        // adding a number after the email if duplicated
        if ($correo == $newCorreo) {

            $i++;
        }
    }

    $newCorreo = $newCorreo . "." . $i;

    return $newCorreo;
}


// function to print the array in a user friendly way
function printArray($array)
{

    foreach ($array as $key => $element) {

        echo ("$key -> $element <br>");
    }
}

// setting the array
$correos = array("alvaro.cangon@dwes.es", "pepecg.cangon@dwes.es", "alvarofn.cangon@dwes.es");


// adding a user
correos("Canas González, Alvaro Francisco Nicolas", "70260135B", $correos);
printArray($correos);
echo ("<br> <br>");

// adding another user
correos("Canas González, Alvaro Francisco Nicolas", "70260136B", $correos);
printArray($correos);
echo ("<br> <br>");

// adding a third user
correos("Canas González, Alvaro Francisco Nicolas", "70260137B", $correos);
printArray($correos);
echo ("<br> <br>");

// adding a forth user
correos("Canas González, Alvaro Francisco Nicolas", "70260138B", $correos);
printArray($correos);
echo ("<br> <br>");
