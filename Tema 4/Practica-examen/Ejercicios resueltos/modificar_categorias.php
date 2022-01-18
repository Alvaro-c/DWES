<?php
/*comprueba que el usuario haya abierto sesión o redirige*/
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_gestion();

// Se comprueba si hay datos en el post y si los hay se intenta actualizar la categoría correspondiente
// Compruebo si el POST viene de modificar o de agregar una categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Modificar'])) {
    $actualizado = actualizar_categoria($_POST);
    if ($actualizado === TRUE) {
        echo "<p>Datos actualizados correctamente</p>";
    } else {
        echo "<p>Error al actualizar los datos</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST[':agregar'])) {

    $actualizado = alta_categoria($_POST);
    if ($actualizado === TRUE) {
        echo "<p>Categoría añadida</p>";
    } else {
        echo "<p>Error al añadir la categoría</p>";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <title>Modificar categorías</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'cabecera.php';?>
<h1>Modificar categorías</h1>
<!--lista de vínculos con la forma
productos.php?categoria=1-->
<?php
$categorias = cargar_categorias();

if($categorias===false){
    echo "<p class='error'>Error al conectar con la base datos</p>";
}else{
    // Carga de los formularios correspondientes a cada categoría para su modificación
    echo "<table>"; //abrir la tabla
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Enlace</th></tr>";
    foreach ($categorias as $categoria) {
        $CodCat = $categoria['CodCat'];
        $nombre = $categoria['Nombre'];
        $descripcion = $categoria['Descripcion'];
        $url = "modificar_productos.php?categoria=".$categoria['CodCat'];
        $enlace = $nombre. ".php";
        echo "<tr>
            <form action = 'modificar_categorias.php' method = 'POST'>
            <td><input name = ':nombre' value = '$nombre'></td>
            <td><input name = ':descripcion' value = '$descripcion'></td>
            <td><a href='$url'>".$categoria['Nombre']."</a></td>
            <input name = ':CodCat'  type='hidden'  value = '$CodCat'>
            <td><input name='Modificar' type = 'submit' value='Modificar'></td>
			</form>
            </tr>";
    }
    echo "</table>";

    // Formulario para añadir nueva categoría
    echo "<h2>Añadir nueva categoría</h2>";
    echo "<table>"; //abrir la tabla
    echo "<tr><th>Nombre</th><th>Descripción</th><th></tr>";
    echo "<tr>
            <form action = 'modificar_categorias.php' method = 'POST'>
            <td><input name = ':nombre' value = ''></td>
            <td><input name = ':descripcion' value = ''></td>
            <td><input name=':agregar' type = 'submit' value='Añadir'></td>
			</form>
            </tr>";
    echo "</table>";
}
?>
</body>
</html>