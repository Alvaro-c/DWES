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
    <title>Eliminar Datos</title>
</head>

<body>
    <?php
    require 'cabecera.php';

    /*
	Si recibe datos por post procede a procesarlos y 
	actualizar la base de datos con ellos.
	*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST[':codprod'])) {
            $eliminado = eliminar_producto($_POST[':codprod']);

            if ($eliminado === TRUE) echo "Producto eliminado.";
            else echo "Producto descatalogado.";
        } else {
            $eliminado = eliminar_categoria($_POST);

            if ($eliminado === TRUE) echo "Categoría eliminada.";
            else echo "Categoría descatalogada.";
        }
    }

    $productos = cargar_todos_productos();
    $categorias = cargar_categorias();

    echo "<h1>Eliminar Producto</h1>";
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Descripción</th></tr>";

    /*
	Se recogen los datos devueltos y se muestran en una tabla con un para que
	los usuarios puedan elegir que elementos eliminar.
	*/
    foreach ($productos as $producto) {
        $cod = $producto['CodProd'];
        $nom = $producto['Nombre'];
        $des = $producto['Descripcion'];
        $peso = $producto['Peso'];
        $stock = $producto['Stock'];
        $codprod = $producto['CodProd'];

        echo "<tr>
            <td>$cod</td>
            <td>$nom</td>
            <td>$des</td>
            <form action = 'bajas_prod_cat.php' method = 'POST'>
            <input name = ':codprod'  type='hidden'  value = '$codprod'>
            <td><input type = 'submit' value='Eliminar'></td>
            </form>
            </tr>";
    }

    echo "</table>";


    echo "<h1>Eliminar Categoría</h1>";
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Descripción</th></tr>";

    /*
	Se recogen los datos devueltos y se muestran en una tabla con un para que
	los usuarios puedan elegir que elementos eliminar.
	*/
    foreach ($categorias as $categoria) {
		$nombre = $categoria['Nombre'];
		$descripcion = $categoria['Descripcion'];
		$codcat = $categoria['CodCat'];

        echo "<tr>
            <td>$codcat</td>
            <td>$nombre</td>
            <td>$descripcion</td>
            <form action = 'bajas_prod_cat.php' method = 'POST'>
            <input name = ':codcat'  type='hidden'  value = '$codcat'>
            <td><input type = 'submit' value='Eliminar'></td>
            </form>
            </tr>";
    }

    echo "</table>";


    ?>

</body>

</html>