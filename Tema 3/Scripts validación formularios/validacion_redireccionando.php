<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {  	
	if($_POST['usuario'] === "usu" and $_POST["clave"] === "12"){
		header("Location: redireccionado.php");
	}else{
		$err = true;
	}	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Validadción de datos en el propio formulario</title>		
		<meta charset = "UTF-8">
	</head>
	<body>			
		<?php if(isset($err)){
			echo "<p> Revise usuario y contraseña</p>";
		}?>
		<form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "POST">
			<label for = "usuario">Usuario</label> 
			<input value = "<?php if(isset($_POST['usuario']))echo $_POST['usuario'];?>"
			id = "usuario" name = "usuario" type = "text">				
			<label for = "clave">Clave</label> 
			<input id = "clave" name = "clave" type = "password">			
			<input type = "submit">
		</form>
	</body>
</html>