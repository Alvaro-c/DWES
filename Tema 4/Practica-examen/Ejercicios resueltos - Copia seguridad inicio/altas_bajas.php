<?php
	/*comprueba que el usuario haya abierto sesión o redirige*/
	require 'sesiones.php';
	require_once 'bd.php';
	comprobar_sesion();
	comprobar_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$fich = fopen ($_FILES["fichero"]["tmp_name"],'r');
	if ($fich === False){
        echo "No se encuentra el fichero o no se pudo leer<br>";
    }else{
        while( !feof($fich)){
            $registro = fscanf($fich, "%s %s %d");
            If (!alta_restaurante($registro)){
              $err = "Error al registrar el restaurante: " . $registro[0];
            }
        }
        fclose($fich);
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Altas y bajas</title>
	</head>
	<body>
		<?php require 'cabecera.php';?>
		<h1>Altas</h1>	
        <?php if (isset($err)) { 
            echo $err;
            } ?>
        <form action="altas_bajas.php" method="post" enctype="multipart/form-data">    
            Escoja un fichero
            <input type="file" name="fichero">
            <input type="submit" value="Subir fichero">
        </form>

        <h1>Bajas</h1>	
        <?php 
        if (isset($_GET['error'])) {
            echo "Clave incorrecta";
        }
        if (isset($_GET['correcta'])) {
            echo "Clave correcta. Procediendo al borrado";
            if (eliminar_restaurante(array(":correo" => $_SESSION[':correo']))){
                echo "<br> Datos borrados";
            } else {
                echo "<br> Error al borrar";
            }
        }
        ?>
        <form action="confirmar_admin.php" method="get">    
        <input name = 'correo'>
        <input type="submit" value="Borrar datos">
        </form>
    </body>
</html>
