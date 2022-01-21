<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_gestion();

// Se comprueba si hay datos en el post y si los hay se elimina la categoría o producto correspondiente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarCat'])) {
    $actualizado = eliminar_categorias($_POST[':CodCat']);
    if ($actualizado === TRUE) {
        echo "<p>Datos actualizados correctamente</p>";
    } else {
        echo "<p>Error al actualizar los datos</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarProd'])) {

    $actualizado = eliminar_productos($_POST[':CodProd']);
    if ($actualizado === TRUE) {
        echo "<p>Datos actualizados correctamente</p>";
    } else {
        echo "<p>Error al actualizar los datos</p>";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar categorías</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'cabecera.php'; ?>

<h1>Eliminar categorías y productos</h1>
<!--lista de vínculos con la forma
productos.php?categoria=1-->

<form action="bajas_prod_cat.php" method="get">
    <select name="seleccion">
        <option>Categorias</option>
        <option>Productos</option>
    </select>
    <input type="submit" value="Seleccionar">
</form>


<?php

if (isset($_GET['seleccion']) && $_GET['seleccion'] == 'Categorias') {


    $categorias = cargar_categorias();
    echo "<h2>Eliminar categorías</h2>";

    if ($categorias === false) {
        echo "<p class='error'>Error al conectar con la base datos</p>";
    } else {
        // Carga de los formularios correspondientes a cada categoría para su modificación
        echo "<table>"; //abrir la tabla
        echo "<tr><th>Nombre</th><th>Descripción</th><th>Enlace</th></tr>";
        foreach ($categorias as $categoria) {
            $CodCat = $categoria['CodCat'];
            $nombre = $categoria['Nombre'];
            $descripcion = $categoria['Descripcion'];
            $url = "modificar_productos.php?categoria=" . $categoria['CodCat'];
            $enlace = $nombre . ".php";
            echo "<tr><td>$nombre</td><td>$descripcion</td><td><a href='$url'>" . $categoria['Nombre'] . "</a></td>
            <form action = 'bajas_prod_cat.php' method = 'POST'>
            <input name = ':CodCat'  type='hidden'  value = '$CodCat'>
            <td><input  type = 'submit' name='eliminarCat' value='Eliminar'></td>
			</form>
            </tr>";
        }
        echo "</table>";
    }
} elseif (isset($_GET['seleccion']) && $_GET['seleccion'] == 'Productos') {


// Aprovecho la función cargar_productos_categoria()
// haciendo injección SQL para jugar un poco con el código y buscarle las vueltas
    if (leer_cookie('descatalogado', 0) == 1) {
        // Se quieren ver todos los productos
        // Aprovecho la función cargar_productos_categoria()
        // haciendo injección SQL para jugar un poco con el código y buscarle las vueltas
        $productos = cargar_productos_categoria_gestion(" 0 or 1=1 --");
    } else {
        // no se quieren ver los productos descatalogados
        $productos = cargar_productos_categoria_gestion_descat(0);
    }
    echo "<h2>Eliminar productos</h2>";

    echo "<table>"; //abrir la tabla
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th></tr>";

    foreach ($productos as $producto) {
        if ($producto['Stock'] >= 0) {

            $CodProd = $producto['CodProd'];
            $nom = $producto['Nombre'];
            $des = $producto['Descripcion'];
            $peso = $producto['Peso'];
            $stock = $producto['Stock'];
            $categoria = $producto['CodCat'];

            echo "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$stock</td>
			<td><form action = 'bajas_prod_cat.php' method = 'POST'>
			<input name = ':CodProd' type='hidden' value = '$CodProd'>
			<input type = 'submit' name='eliminarProd' value='Eliminar'>
			</form></td></tr>";
        }

    }
}
?>
</body>
</html>
