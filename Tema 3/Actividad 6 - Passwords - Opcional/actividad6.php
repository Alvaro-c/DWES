<?php


// Función para comprobar si un usuario ya existe
function compruebaUser($nuevoUser) {

    $fichero = fopen("acceso.txt", "r");

    while(!feof($fichero)) {

        $usuario = fscanf($fichero, "%s %s %d %s");

        if ($usuario[0] == $nuevoUser) {

            return true;
        }

    }

    return false;

}

session_start();

if($_POST['submit'] == 'submit') {

    $_SESSION['submit'] = 'submit';

}

// Compronar si el nombre está escrito y no tiene caracteres raros
if ($_POST['usuario'] == "" || !ctype_alnum($_POST['usuario'])) {

    $_SESSION['userError'] = true;
    $_SESSION['passError'] = false;
    $_SESSION['userDupe'] = false;
    header("Location: index.php");

    // comprobar si la pass está escrita y no tiene caracteres raros
} else if ($_POST['password'] == "" || !ctype_alnum($_POST['password'])) {

    $_SESSION['userError'] = false;
    $_SESSION['passError'] = true;
    $_SESSION['userDupe'] = false;
    header("Location: index.php");

    //comprobar si el usuario ya existe
} else if (compruebaUser($_POST['usuario'])) {

    $_SESSION['userError'] = false;
    $_SESSION['passError'] = false;
    $_SESSION['userDupe'] = true;
    header("Location: index.php");

    // caso correcto
} else {

    // Guardar el fichero
    $salt = randomString(20);
    $usuario = $_POST['usuario'];
    $password = crypt($_POST['password'], $salt);
    $rol = "0";


    $archivo = file_put_contents("acceso.txt", "\n$usuario $password $rol $salt", FILE_APPEND);
    
    echo "Usuario guardado<br>";
    echo '<a href="index.php"> Volver a inicio</a>';
}

// Función para generar cadenas aleatorias dado un numero
function randomString($num) {

    $string = "$6$";
    $chars = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    for ($i = 0; $i < $num; $i++) {

        $newChar = substr($chars, rand(0, (strlen($chars)-1)), 1);
        $string = $string. $newChar;

    }

    return $string;
}
