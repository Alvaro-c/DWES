<?php
function generar_correo($nombre_completo, $dni, $correos)
{
    /* --- TRATAMOS EL NOMBRE DE USUARIO ---*/
    //Eliminamos acentos, caracteres especiales como la ñ, y mayúsculas
    $nombre_completo = strtolower(eliminar_tildes($nombre_completo));

    //Buscamos la coma en el $nombre_completo
    $posicion_coma = strpos($nombre_completo, ",");
    //Calculamos la longitud de $nombre_completo
    $longitud_nombre = strlen($nombre_completo);
    //Para tratar el $nombre_completo usamos la función substr, los dos últimos argumentos indican la posición inicial y la longitud total de la cadena a extraer.
    //Tratmos el nombre y los apellidos por separado e iremos generado el nombre de usuario del correo electrónico en la variable $nombre_usuario.

    /* --- TRATAMOS EL NOMBRE --- */
    //Extraemos el nombre con la función substr, desde una posición más de la coma hasta el final de la cadena
    //Eliminamos los espacios en blanco iniciales y finales con trim
    $nombre = trim(substr($nombre_completo, $posicion_coma + 1, $longitud_nombre - $posicion_coma));
    //Tomamos cada uno de los nombre, si los hubiera.
    //Para ello buscamos el espacio en blanco entre apellidos, si no existe, devuelve False
    //Si el nombre tuviera menos de tres letras, quitamos los espacios en blanco
    $blanco = strpos($nombre, " ");
    if ($blanco != False) {
        $nombre1 = trim(substr($nombre, 0, $blanco));
        $nombre2 = substr($nombre, $blanco + 1, 1);
        $nombre_usuario = $nombre1 . $nombre2 . ".";
    } else {
        $nombre1 = $nombre;
        $nombre_usuario = $nombre1 . ".";
    }

    /* --- TRATAMOS LOS APELLIDOS --- */
    //Extraemos los apellidos con la función substr, desde la posición inicial, con una longitud igual a la posición de la coma.
    $apellidos = substr($nombre_completo, 0, $posicion_coma);
    //Tomamos los tres primeros caracteres de cada apellido, buscando el espacio en blanco entre apellidos.
    //Si el apellido tuviera menos de tres letras, quitamos los espacios en blanco
    $blanco = strpos($apellidos, " ");
    $apellido1 = trim(substr($apellidos, 0, 3));
    $apellido2 = trim(substr($apellidos, $blanco + 1, 3));
    $nombre_usuario = $nombre_usuario . $apellido1 . $apellido2;

    /* --- TRATAMOS EL POSIBLE NÚMERO DEL NOMBRE DE USUARIO Y GENERAMOS LA DIRECCIÖN DE CORREO --- */
    //Tomamos el $nombre_usuario y lo comparamos con cadenas de la misma longitud que hubiera en CORREOS.
    //Según el número de ellas que coincidan, entonces se ha de añadir un número al final del $nombre_usuario.
    $numero = 0;
    foreach ($correos as $correo) {
        $longitud_usuario = strlen($nombre_usuario);
        if ($nombre_usuario == substr($correo, 0, $longitud_usuario)) {
            $numero = $numero + 1;
        }
    }
    //Si hemos encontrado correos similares, lo añadimos a la dirección de correo.
    if ($numero > 0) {
        $correo_usuario = $nombre_usuario . "." . $numero . "@dwes.es";
    } else {
        $correo_usuario = $nombre_usuario . "@dwes.es";
    }

    /* --- TRATAMOS EL DNI --- */
    $clave = substr($dni, 0, strlen($dni) - 1);

    /* --- MOTRAMOS LA SALIDA PEDIDA Y GUARDAMOS LA NUEVA DIRECCIÓN EN CORREOS --- */
    echo "'" . $nombre_completo . "' - '" . $correo_usuario . "' - '" . $clave . "'<br>";
    $correos[$clave] = $correo_usuario;
    return $correos;
}

include "_acentos.php";
/* --- DATOS INICIALES DEL ARRAY CORREOS --- */
$CORREOS = array(
    "00000001" => "genoveva.mardia@dwes.es",
    "00000002" => "pilare.munrey@dwes.es",
    "00000003" => "aitor.mardom@dwes.es",
    "00000004" => "pilare.munrey.1@dwes.es",
    "00000005" => "hugop.rosfue@dwes.es"
);

/* --- PROBAMOS A INTRODUCIR OTROS DATOS --- */
$nombre = "Muñoz Reyes, Pilar Encarnación";
$dni = "00000006A";
$CORREOS = generar_correo($nombre, $dni, $CORREOS);

$nombre = "Castro Nuñez, Luis Carlos";
$dni = "00000007A";
$CORREOS = generar_correo($nombre, $dni, $CORREOS);

$nombre = "Martinez Díaz, Genoveva";
$dni = "00000008A";
$CORREOS = generar_correo($nombre, $dni, $CORREOS);

echo "<pre>";
print_r($CORREOS);
echo "</pre>";