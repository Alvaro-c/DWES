<!-- 
1.- Idea con los bloques If
	¿Cómo combinar etiquetas HTML con sentencias php?
	Pensando que la parte básica es el HTML y lo que incrustamos es php. Por tanto:
		Cada sentencia php ha de ir entre < ?php y ?>, aunque sea una simple llave.
		Ejemplos: 
			líneas 13-18
			líneas 29-33
			líneas 42-46
			líneas 55-58
			líneas 67-69
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
		?>
 		<form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
			<p>Idioma:</p>
			<input type="radio" name="idioma" value="en"/>
			Inglés<br/>
			<input type="radio" name="idioma" value="es"/>
			Español<br/>
			<input type="submit" value="Enviar" name="enviar"/>
		</form>
		<?php
	}
	if ($_COOKIE['Idioma'] == 'en') {
		echo "Cookie in English";
		?>
 		<form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
			<p>Language:</p>
			<input type="radio" name="idioma" value="en"/>
			English<br/>
			<input type="radio" name="idioma" value="es"/>
			Spanish<br/>
			<input type="submit" value="Send" name="enviar"/>
		</form>
		<?php
	}
} else {
?>
<form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<p>Idioma:</p>
		<input type="radio" name="idioma" value="en"/>
		Inglés<br/>
		<input type="radio" name="idioma" value="es"/>
		Español<br/>
		<input type="submit" value="Enviar" name="enviar"/>
	</form>
	<?php
}
?>

</body>
</html>