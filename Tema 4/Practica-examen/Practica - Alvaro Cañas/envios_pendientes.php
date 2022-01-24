<?php
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_gestion();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Envíos pendientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'cabecera.php'; ?>
<h1>Envíos pendientes</h1>



    <?php

    $productos = cargar_productos_pendientes();
    // El siguiente if comprueba si se ha pulsado el botón de exportar documento y generaría un txt con los productos
    if (isset($_POST['txt'])) {
        exportar_txt($productos);
        $productos = cargar_productos_pendientes();
    }

    // Si se actualizan las unidades pendientes se comprueba en bd.php si ha sido cambiado a 0 y se actualizan productos y pedidos
    if (isset($_POST['pendientes']) && $_POST[':UdPend'] == 0) {
        $CodProd = $_POST[':CodProd'];
        $CodPed = $_POST[':CodPed'];
        comprobar_pendientes($CodProd, $CodPed);
        $productos = cargar_productos_pendientes();
    } else if (isset($_POST[':UdPend'])){
        $CodProd = $_POST[':CodProd'];
        $CodPed = $_POST[':CodPed'];
        actualizar_pendientes($CodProd, $CodPed,$_POST[':UdPend']);
        $productos = cargar_productos_pendientes();
    }

    // si hay productos se muestran en la tabla, sino se muestra un mensaje avisando de que no hay envíos pendientes
    if ($productos) {

        echo "<form action='envios_pendientes.php' method='post'>
                <input name='txt' type='submit' value='Generar documento'>
                </form>";

        echo "<table>"; //abrir la tabla
        echo "<tr><th>Código Restaurante</th><th>Correo</th><th>Código pedido</th><th>Fecha</th><th>Código Producto</th><th>Nombre</th><th>Unidades pendientes</th></tr>";

        foreach ($productos as $producto) {

            $CodRes = $producto['CodRes'];
            $Correo = $producto['Correo'];
            $CodPed = $producto['CodPed'];
            $Fecha = $producto['Fecha'];
            $CodProd = $producto['CodProd'];
            $Nombre = $producto['Nombre'];
            $UdPend = $producto['UdPend'];

            echo "<tr>
                    <form action = 'envios_pendientes.php' method = 'POST'>
                    <td><input name = ':CodRes' value = '$CodRes' readonly></td>
                    <td><input name = ':Correo' value = '$Correo' readonly></td>
                    <td><input name = ':CodPed' value = '$CodPed' readonly></td>
                    <td><input name = ':Fecha' value = '$Fecha' readonly></td>
                    <td><input name = ':CodProd' value = '$CodProd' readonly></td>            
                    <td><input name = ':Nombre' value='$Nombre' readonly></td>
                    <td><input name = ':UdPend' value='$UdPend'></td>
                    <td><input name='pendientes' type = 'submit' value = 'Actualizar'></td>
                    </form>
                    </tr> ";

        }
    } else {
        echo "No hay productos pendientes";

    }
?>
</table>


</body>
</html>
