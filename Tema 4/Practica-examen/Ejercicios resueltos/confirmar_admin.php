<?php
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
comprobar_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	$usu = comprobar_usuario($_SESSION['usuario']['Correo'], $_POST['clave']);
	if($usu===false){
		header("Location: altas_bajas.php?error=TRUE");
	}else{
		header("Location: altas_bajas.php?correcta=TRUE");
	}	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Confirmación de clave</title>
		<meta charset = "UTF-8">
	</head>
	<body>
        Introduzca de nuevo su clave para proceder al borrado:
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $_SESSION[':correo'] = $_GET['correo'];
        }?>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">	
			<label for = "clave">Clave</label> 
			<input id = "clave" name = "clave" type = "password">					
			<input type = "submit">
		</form>
	</body>
</html>