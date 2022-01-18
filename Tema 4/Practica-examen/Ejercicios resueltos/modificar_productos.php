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
</head>

<body>
<?php
require 'cabecera.php';

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

        echo "<tr>
            <form action = 'modificar_productos.php' method = 'POST'>
            <td><input name = ':nombre' value = '$nom' ></td>
            <td><input name = ':descripcion' value = '$des'></td>
            <td><input name = ':peso' value = '$peso' ></td>
            <td><input name = ':stock' value = '$stock' ></td>           
            <input name = ':CodProd'  type = 'hidden'  value = '$cod'>
            <td ><input type = 'submit' value = 'Modificar' ></td>
			</form>
            </tr> ";
    }

    echo "</table> ";


}
?>
</body>

</html>