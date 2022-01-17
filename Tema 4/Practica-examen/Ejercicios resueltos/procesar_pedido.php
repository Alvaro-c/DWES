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
    <style>
        table {
            border-collapse: collapse;
            font-family: Tahoma, Geneva, sans-serif;
        }
        table td {
            padding: 15px;
        }
        table thead td {
            background-color: #54585d;
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
            border: 1px solid #54585d;
        }
        table tbody td {
            color: #636363;
            border: 1px solid #dddfe1;
        }
        table tbody tr {
            background-color: #f9fafb;
        }
        table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

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
if ($faltan) {

    // Utilizo esta función que venía en el programa original para recoger los datos de los productos que faltan
    // Utilizo esta función en lugar de la función cargar_sin_stock()
    $productos = cargar_productos(array_keys($faltan));

    echo "<h2>Faltan los siguientes productos</h2>";
    echo "<table>"; //abrir la tabla
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Categoría</th><th>Ud que faltan</th><th>Ud disponibles</th></tr>";
    foreach ($productos as $producto) {
        $cod = $producto['CodProd'];
        $nom = $producto['Nombre'];
        $des = $producto['Descripcion'];
        $categoria = get_categoria($producto['CodCat']);
        $unidadesPed = $faltan[$cod];
        $unidadesDispo = $producto['Stock'];

        echo "<tr><td>$nom</td><td>$des</td><td>$categoria</td><td>$unidadesPed</td><td>$unidadesDispo</td>";
    };

    echo "</tr></table>";
    echo "<form action='procesar_pedido.php'><input class='boton' type='button' name='tramitar' value='Tramitar pedido'></form>";
}


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
?>
</body>
</html>