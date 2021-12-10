<?php

// funcion a modificar
function comprobar_usuario($nombre, $clave)
{
    // abro fichero y lo recorro para comparar usuario y contraseña con cada linea del fichero
    $fichero = fopen("acceso.txt", "r");
    while (!feof($fichero)) {

        $usuario = fscanf($fichero, "%s %s %d %s");
        $claveHash = crypt($clave, $usuario[3]);

        // comprobación del usuario y la contraseña
        if ($usuario[0] == $nombre && $usuario[1] == $claveHash) {

            $usu['nombre'] = $nombre;
            $usu['rol'] = $usuario[2];
            return $usu;
        }
    }

    return false;

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {  	
	$usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
	if($usu==false){
		$err = true;
		$usuario = $_POST['usuario'];
	}else{	
		session_start();
		$_SESSION['usuario'] = $_POST['usuario'];
		header("Location: sesiones1_principal.php");	
	}	
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
    if ($usu == false) {
        $err = true;
        $usuario = $_POST['usuario'];
    } else {
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        header("Location: sesiones1_principal.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulario de login</title>
    <meta charset="UTF-8">
</head>

<body>
    <?php if (isset($_GET["redirigido"])) {
        echo "<p>Haga login para continuar</p>";
    } ?>
    <?php if (isset($err) and $err == true) {
        echo "<p> revise usuario y contraseña</p>";
    } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Usuario
        <input value="<?php if (isset($usuario)) echo $usuario; ?>" id="usuario" name="usuario" type="text">
        Clave
        <input id="clave" name="clave" type="password">
        <input type="submit">
    </form>
</body>

</html>