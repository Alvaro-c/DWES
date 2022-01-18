<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificar productos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
require 'cabecera.php';

// Se comprueba si hay datos en el post y si los hay se intenta actualizar el producto correspondiente
// Compruebo si el POST viene de modificar o de agregar un producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Modificar'])) {
    $actualizado = actualizar_producto($_POST);
    if ($actualizado === TRUE) {
        echo "<p>Datos actualizados correctamente</p>";
        // Recojo la categoría del $_POST y se lo paso al $_GET para seguir mostrando la misma categoría
        $_GET['categoria'] = $_POST[':CodCat'];
    } else {
        echo "<p>Error al actualizar los datos</p>";
        $_GET['categoria'] = $_POST[':CodCat'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST[':agregar'])) {

    $actualizado = alta_producto($_POST);
    $_GET['categoria'] = $_POST[':CodCat'];
    if ($actualizado === TRUE) {
        echo "<p>Producto añadido</p>";
    } else {
        echo "<p>Error al añadir el producto</p>";
    }

}


// Se comprueba si se ha seleccionado una categoría y sino se cargan todos los productos
if (isset($_GET['categoria'])) {
    $cat = cargar_categoria($_GET['categoria']);
    $_SESSION['cat'] = $_GET['categoria'];
    $productos = cargar_productos_categoria($_GET['categoria']);
    echo "<h1>Modificar productos de categoría " . $cat['Nombre'] . "</h1>";
    echo "<p>" . $cat['Descripcion'] . "</p>";

    if ($cat === FALSE or $productos === FALSE) {
        echo "<p class='error'>Error al conectar con la base datos</p>";
        exit;
    }
} else {
    // Aprovecho la función cargar_productos_categoria()
    // haciendo injección SQL para jugar un poco con el código y buscarle las vueltas
    $productos = cargar_productos_categoria(" 0 or 1=1 --");
    echo "<h1>Modificar productos</h1>";
}

echo "<table>"; //abrir la tabla
echo "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th></tr>";

foreach ($productos as $producto) {
    if ($producto['Stock'] >= 0) {

        $cod = $producto['CodProd'];
        $nom = $producto['Nombre'];
        $des = $producto['Descripcion'];
        $peso = $producto['Peso'];
        $stock = $producto['Stock'];
        $categoria = $producto['CodCat'];

        echo "<tr>
            <form action = 'modificar_productos.php' method = 'POST'>
            <td><input name = ':nombre' value = '$nom'></td>
            <td><input name = ':descripcion' value = '$des'></td>
            <td><input name = ':peso' value = '$peso'></td>
            <td><input name = ':stock' value = '$stock'></td>           
            <input name = ':CodProd'  type = 'hidden'  value='$cod'>
            <input name = ':CodCat'  type = 'hidden'  value='$categoria'>
            <td><input name='Modificar' type = 'submit' value = 'Modificar'></td>
			</form>
            </tr> ";
    }
}
?>
</table>

<?php
echo "</table>";

if (isset($_GET['categoria'])) {
$categoria = $_GET['categoria'];

// Formulario para añadir nuevo producto
    echo "<h2>Añadir nuevo producto</h2>";
    echo "<table>"; //abrir la tabla
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th></tr>";
    echo "<tr>
            <form action = 'modificar_productos.php' method = 'POST'>
            <td><input name = ':nombre' value = ''></td>
            <td><input name = ':descripcion' value = ''></td>
            <td><input name = ':peso' value = ''></td>
            <td><input name = ':stock' value = ''></td>           
            <input name = ':CodProd'  type = 'hidden'  value='default'>
            <input name = ':CodCat'  type = 'hidden'  value='$categoria'>
            <td><input name=':agregar' type = 'submit' value = 'Añadir'></td>
			</form>
            </tr> ";
    echo "</table>";

}

?>
</body>

</html>