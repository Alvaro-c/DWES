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
    <title>Crear Producto</title>
</head>

<body>
    <?php
    require 'cabecera.php';

    /*
	Si recibe datos por post procede a procesarlos y 
	actualizar la base de datos con ellos.
	*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $actualizado = alta_producto($_POST);
        if ($actualizado === TRUE) {
            echo "<p>Producto creado correctamente</p>";
        } else {
            echo "<p>Error al actualizar los datos</p>";
        }
    }

    /*
	Se recogen los datos devueltos y se muestran en una tabla con un formulario para que
	los campos puedan ser cambiados.
	*/
    echo "<h1>Crear Producto</h1>
            <form action = 'nuevo_producto.php' method = 'POST'>
            Nombre: <input name = ':nombre'> <br/> <br/>
            Descripción: <input name = ':descripcion'> <br/> <br/>
			Peso: <input name = ':peso'> <br/> <br/>
			Stock: <input name = ':stock' type='number'> <br/> <br/>
			Código de Categoría: <input name = ':codcat'> <br/> <br/>
            <input type = 'submit' value='Crear'>
			</form>";

    ?>

</body>

</html>