<?php
// Comenzamos con el formulario de registro, ejercicio 1.
// Nos basamos en sesiones1_login.php. Le cambiamos el nombre a sesiones1_registro.php
// ¿Qué tiene que hacer registro? Formulario que metamos usu y contraseña, entonces:
//  ----- Si usu o contraseña invalida ----> Mostramos mensaje de advertencia
//  ----- Si usu está en acceso.txt ----> "Usuario ya registrado, haga login para continuar"
//  ----- Si usu no está en acceso.txt y usu y contraseña valida ----> "Registrado correctamente, haga login para continuar"
// 			Extra -> añadimos un delay (función sleep) y una redirección


// Tenemos que introducir diferentes modificaciones.
//     El usuario no puede estar vacío y solo puede contener caracteres alfanuméricos sin espacios
//     La contraseña no puede estar vacía, **tener espacios** y solo contener caracteres alfanuméricos
// para los espacioes en blanco, strpos busca una cadena en otra, sino la encuentra, devuelvo FALSE
// OJO si el espacio está en la primera posición entonces devuelve 0, lo que php interpreta a FALSE
// por eso utilizamos el operador === identico.

// cambiamos el nombre de la función a comprobar_usuario_clave. En esta función comprobamos si son correctos
// Devolvemos 	-1 si el nombre es incorrecto
//				-2 si la clave es incorrecta
//				FALSE si el usuario ya exite en el fichero
//				TRUE si todo es correcto y podemos guardar en el fichero
function comprobar_usuario_clave($nombre, $clave){
	if(!(isset($nombre) and (strpos($nombre," ")=== False) and ctype_alnum($nombre))){
		// devolvemos -1 si el nombre es erroneo
		return -1;
	}
	if(!(isset($clave) and (strpos($clave," ")=== False) and !(ctype_alnum($clave)))){
		// devolvemos -2 si el nombre es correcto
		return -2;
	}
	// Ahora toca buscar el usuario en el archivo, para ello tenemos que coger el contenido del fichero
	// Usamos el ejemplo ficheros_fscanf.php
	// Abrimos el fichero
	$fich = fopen("acceso.txt", "r");
	if ($fich === False){
		echo "No se encuentra el fichero o no se pudo leer<br>";
	}else{
		// Recorremos el archivo mientras no sea el final y lo tengamos que incorporar
		$incorporar = TRUE;
		// ponemos el puntero en la primera posición
		//rewind($fich);
		while( !feof($fich) AND $incorporar){
			$registro = fscanf($fich, "%s %s %d");
			if ($registro[0] == $nombre){
				$incorporar = FALSE;
			}
		}
		//Cerramos el fichero y analizamos la salida del bucle
		//Si lo tenemos que incorporar entonces comprobar_usuario_clave() ha de devolver TRUE al no encontrar problemas
		fclose($fich);
		if ($incorporar == FALSE) {
			return False;
		}else{
			return True;
		}
	}
}

//Al enviar los datos del formulario comprobamos si los datos de nombre y clave cumplen con lo especificado
if ($_SERVER["REQUEST_METHOD"] == "POST") { 	
	$usu = comprobar_usuario_clave($_POST['usuario'], $_POST['clave']);
	// buscamos si ha habido algún error, -1 para el usuario y -2 para la clave
	if($usu === -1 or $usu === -2){
		$err = true;
		// Si la clave era la que estaba mal, entonces guardo el nombre de ususario para mostrarlo en el formulario de nuevo
		if ($usu == -2){
			$usuario = $_POST['usuario'];
		}
	}elseif($usu===TRUE){
		// En caso de no haber error guardamos en el fichero
		// FILE_APPEND: Si el fichero ya existe, añade la información al fichero en vez de sobrescribirlo.
		// LOCK_EX: Adquirir acceso exclusivo al fichero mientras se está ejecutando la escritura
		file_put_contents("acceso.txt", "\n". $_POST['usuario'] ." ". $_POST['clave'] ." 0", FILE_APPEND | LOCK_EX);
		// Y redirigimos login igual que hacíamos en logout
		header("Location: sesiones1_login - mod.php?registrado=true");
	}else {
		// en caso de no poder guardar por ya estar el usuario en la base de datos
		$guardado = FALSE;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Cambiamos el nombre -->
		<title>Formulario de registro</title>		
		<meta charset = "UTF-8">
	</head>
	<body>
		<!-- Eliminamos la parte del get, que venía del formulario de logout
		//?php if(isset($_GET["redirigido"])){
		//	echo "<p>Haga login para continuar</p>";
		//?> 
		 -->
		<?php
		if(isset($err) and $err == true){
			echo "<p> Revise usuario y clave</p>";
		}
		if(isset($guardado) and $guardado == False){
			echo "<p> Usuario ya registrado </p>";
		}
		?>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			Usuario
			<input value = "<?php if(isset($usuario))echo $usuario;?>"
			id = "usuario" name = "usuario" type = "text">							
			Clave			
			<input id = "clave" name = "clave" type = "password">						
			<input type = "submit">
		</form>
		<!-- Añadimos un enlace a login -->
		<br><a href = "sesiones1_login.php"> Login <a></br>
	</body>
</html>