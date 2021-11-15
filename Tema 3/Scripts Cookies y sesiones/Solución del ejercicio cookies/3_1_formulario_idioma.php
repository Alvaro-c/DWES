<!-- 
Ya hemos comprobado que la cookie funciona correctamente, vamos a abordar el problema de cambiar de idioma según su valor.
Las ideas generales cuando uno busca una solución a esto son:
	1.- Meter el código HTML del formulario dentro de bloques If, los cuales muestren el formulario según el idioma de la cookie.
	2.- Cambiar cada texto del formulario según el idioma seleccionado.
	Una primera aproximación es la siguiente:
-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	setcookie('Idioma', $_POST['idioma'], time() + 3600 * 24);
	header("Location: ".$_SERVER["PHP_SELF"]);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Formulario de idioma</title>
	<meta charset="UTF-8">
</head>

<body>
<?php
if (isset($_COOKIE['Idioma'])) {
	if ($_COOKIE['Idioma'] == 'es') {
		echo "Cookie en español";
/* 		<form name="input" action="1_cookie_idioma.php" method="post">
			<p>Idioma:</p>
			<input type="radio" name="idioma" value="en"/>
			Inglés<br/>
			<input type="radio" name="idioma" value="es"/>
			Español<br/>
			<input type="submit" value="Enviar" name="enviar"/>
		</form> */
	}
	if ($_COOKIE['Idioma'] == 'en') {
		echo "Cookie en inglés";
/* 		<form name="input" action="1_cookie_idioma.php" method="post">
			<p>Idioma:</p>
			<input type="radio" name="idioma" value="en"/>
			Inglés<br/>
			<input type="radio" name="idioma" value="es"/>
			Español<br/>
			<input type="submit" value="Enviar" name="enviar"/>
		</form> */
	}
}
/* Esta aproximación tiene el problema de cómo combinar etiquetas html con instrucciones php, vamos a ver cómo resolverlo en el siguiente script */
?>
<form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<p>Idioma:</p>
		<input type="radio" name="idioma" value="en"/>
		Inglés<br/>
		<input type="radio" name="idioma" value="es"/>
		Español<br/>
		<input type="submit" value="Enviar" name="enviar"/>
	</form>
</body>
</html>