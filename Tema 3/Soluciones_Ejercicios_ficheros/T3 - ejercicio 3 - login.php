<?php


function comprobar_usuario($nombre, $clave){

// 1.- Creamos el fichero acceso.txt con los datos iniciales admin 1234 1 y user 1234 0
$fich = fopen("acceso.txt", "r");

	if ($fich === False){
		echo "No se encuentra el fichero o no se pudo leer<br>";
	}else{
		// Recorremos el archivo mientras no sea el final y no lo hayamos encontrado
		$no_encontrado = TRUE;
		// con esta variable controlamos si la clave la hemos podido verificar en caso de que encontremos al usuario
		$clave_validada = FALSE;
		// ponemos el puntero en la primera posición
		//rewind($fich);
		while( !feof($fich) AND $no_encontrado){
			$registro = fscanf($fich, "%s %s %d");
			if ($registro[0] == $nombre){
				$no_encontrado = FALSE;
				if ($registro[1] == $clave){
					$clave_validada = TRUE;
				}
			}
		}
		fclose($fich);
	//Analizamos los posibles casos:
		//Si no lo hemos encontrado devolvemos -1
		//Si lo hemos encontrado, pero con la clave incorrecta, devolvemos FALSE
		//Si lo hemos encontrado con la clave correcta, devolvemos TRUE
		if ($no_encontrado == FALSE) {
			return -1;
		}elseif($clave_validada == FALSE){
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

	//Según los casos, modificamos el compartamiento del formulario con el siguiente bloque if
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
	if($usu==false){ //Usuario encontrado, pero con clave incorrecta
		$err = true;
		$usuario = $_POST['usuario'];
	}elseif($usu==true){ //Usuario y clave correcta
		session_start();
		$_SESSION['usuario'] = $_POST['usuario'];
		header("Location: sesiones1_principal.php");	
	}else{ //usuario no encontrado
		$err = true;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de login</title>		
		<meta charset = "UTF-8">
	</head>
	<body>	
		<?php if(isset($_GET["redirigido"])){
			echo "<p>Haga login para continuar</p>";
		}
			//añadimos la entrada a login por registro
			if(isset($_GET["registrado"])){
				echo "<p>Registrado con éxito, haga login para continuar</p>";
		}?>
		<?php if(isset($err) and $err == true){
			echo "<p> revise usuario y contraseña</p>";
		}?>
		
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			Usuario
			<input value = "<?php if(isset($usuario))echo $usuario;?>"
			id = "usuario" name = "usuario" type = "text">							
			Clave			
			<input id = "clave" name = "clave" type = "password">						
			<input type = "submit">
		</form>
		<br><a href = "sesiones1_registro.php"> ¿No estás registrado? <a>
	</body>
</html>