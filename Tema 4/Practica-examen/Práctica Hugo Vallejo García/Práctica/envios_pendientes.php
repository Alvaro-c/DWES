<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_responsable();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Productos Pendientes</title>
    <style>
        table {
            text-align: center;
        }
    </style>
</head>

<body>
	<?php
	require 'cabecera.php';

    // ¿Modificando o guardando archivo?
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST[':udped'])) {
            $actualizado = actualizar_envio_pendiente($_POST);

            if($actualizado) {
                echo "<p>Pedido pendiente actualizado</p>";
            } else {
                echo "<p>Error al conectar con la base de datos.</p>";
            }
        } else {
            /* Escribimos en el archivo los datos pasandos por el POST */
            $fich = fopen("enviosPendientes.txt", "c");
			fwrite($fich, $_POST['productos']);

            echo "<p>Fichero con los datos guardado :) (enviosPendientes.txt)</p>";
        }
	}

    $envios_pendientes = cargar_envios_pendientes();
    $textoFichero = "";

    /*
    Creamos el título y la tabla
    */

    echo "<h1>Pedidos Pendientes</h1>
    <p>Estos son los pedidos pendientes actuales</p>
    <table>
    <tr>
    <th>Código Restaurante</th>
    <th>Correo Restaurante</th>
    <th>Código Pedido</th>
    <th>Fecha Pedido</th>
    <th>Código Producto</th>
    <th>Nombre Producto</th>
    <th>Unidades Pendientes</th>
    </tr>";

    /*
    Por cada producto añadimos una fila y añadimos una línea a una string que
    se guardará en el archivo en caso de que el usuario así lo decida.
    */
    foreach($envios_pendientes as $producto) {
        $codRes = $producto['Restaurante'];
        $correoRes = $producto['Correo'];
        $codPed = $producto['CodPed'];
        $fechaPed = $producto['Fecha'];
        $codProd = $producto['CodProd'];
        $nomProd = $producto['Nombre'];
        $udPed = $producto['UdPend'];
        $codPend = $producto['CodPend'];

        echo "<tr>
        <td>$codRes</td>
        <td>$correoRes</td>
        <td>$codPed</td>
        <td>$fechaPed</td>
        <td>$codProd</td>
        <td>$nomProd</td>
        <form action = 'envios_pendientes.php' method = 'POST'>
        <td><input name = ':udped' type = 'number' value = '$udPed'></td>
        <input name = ':codpend' type = 'hidden' value = '$codPend'>
        <input name = ':codped' type = 'hidden' value = '$codPed'>
        <td><input value = 'Modificar' type = 'submit'/></td>
        </form>
        </tr>";

        // Añadimos una línea al texto que se guarda en el archivo
        $textoFichero .= "$codRes - $correoRes | $codPed ($fechaPed): $nomProd ($codProd) x$udPed\n";
    }

    echo "</table> </br>";

    // Formulario para guardar en fichero.
    echo "<form action = 'envios_pendientes.php' method = 'POST'>
    <input type='hidden' name='productos' value='" . $textoFichero . "'/>
    <input value = 'Guardar Fichero' type = 'submit'/>
    </form>"
	?>

</body>

</html>