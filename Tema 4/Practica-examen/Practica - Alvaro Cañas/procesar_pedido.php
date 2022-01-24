<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
/* correo.php requere tener instalada la extensión PHPMAILER, por eso aparece comentada
require 'correo.php'; */
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <link rel="stylesheet" href="style.css">
    <style>


        .boton {
            text-align: center;

        }
    </style>
</head>

<body>
    <?php
    require 'cabecera.php';

    // Ejercicio 2: añadida función falta_stock($carrito). Esta función está en el script BD.php
    $faltan = falta_stock($_SESSION['carrito']);

    // Sino faltan productos, se ejecuta el código con normalidad
    if(!$faltan) {

        $resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['CodRes']);
        if ($resul === FALSE) {
            echo "No se ha podido realizar el pedido<br>";
        } else {
            $correo = $_SESSION['usuario']['Correo'];
            echo "Pedido realizado con éxito. Se enviará un correo de confirmación a: $correo ";
            /* Este bloque comprueba que el correo se ha enviado correctamente con la extensión PHPMailer
                $conf = enviar_correos($_SESSION['carrito'], $resul, $correo);
                if($conf!==TRUE){
                    echo "Error al enviar: $conf <br>";
                };*/
            //vaciar carrito
            $_SESSION['carrito'] = [];
            if (isset($_COOKIE['carrito'])) {
                setcookie('carrito', '', time() - 3600 * 24);
            }
        }


    }


    // si faltan productos, se comprueba si se ha tramitado el pedido comprobando la variable POST
    if (isset($_POST['tramitar'])) {

        $resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['CodRes'], 1);
        // se añaden los productos que faltan a la tabla productospendientes
        insertar_sin_stock($faltan, $resul);
        if ($resul === FALSE) {
            echo "No se ha podido realizar el pedido<br>";
        } else {
            $correo = $_SESSION['usuario']['Correo'];
            echo "Pedido realizado con éxito. Se enviará un correo de confirmación a: $correo ";
            /* Este bloque comprueba que el correo se ha enviado correctamente con la extensión PHPMailer
                $conf = enviar_correos($_SESSION['carrito'], $resul, $correo);
                if($conf!==TRUE){
                    echo "Error al enviar: $conf <br>";
                };*/
            //vaciar carrito
            $_SESSION['carrito'] = [];
            if (isset($_COOKIE['carrito'])) {
                setcookie('carrito', '', time() - 3600 * 24);
            }
        }
    } else {

        // Sino se ha tramitado el pedido, se muestran por pantalla los productos de los que no se tiene stock
        if ($faltan) {
            cargar_sin_stock($faltan);
        }
    }

    ?>
</body>

</html>