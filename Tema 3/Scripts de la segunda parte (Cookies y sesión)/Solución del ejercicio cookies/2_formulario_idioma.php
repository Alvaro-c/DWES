<!-- 
Vamos a mejorar el script anterior.
1.- Hacemos que el action del formulario llame al propio formulario en vez de a otro script distinto.
De esta manera, tenemos la estructura:
	< ?php 
	 	...
	?>
	<html>
		...
	</html>
2.- En el bloque de php hemos de tener en cuenta que:
 	a) Solo accedemos a él si damos al botón de enviar
	b) Podemos utilizar header("Location: ") para llamar al propio formulario, de esta forma, se recarga por sí mismo detectando la cookie
-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	setcookie('Idioma', $_POST['idioma'], time() + 3600 * 24);
	header("Location: 2_formulario_idioma.php"); //Ya que se llama así, mismo, es más adecuado 	utilizar la sentencia header("Location: ".$_SERVER["PHP_SELF"]);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Formulario de idioma</title>
	<meta charset="UTF-8">
</head>

<body>
	<form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<p>Idioma:</p>
		<input type="radio" name="idioma" value="en" />
		Inglés<br />
		<input type="radio" name="idioma" value="es" />
		Español<br />
		<input type="submit" value="Enviar" name="enviar" />
	</form>
	<?php
	echo "<p> Comprobación: </p>";
	if (isset($_COOKIE['Idioma'])) {
		if ($_COOKIE['Idioma'] == 'es') {
			echo "Cookie en español";
		}
		if ($_COOKIE['Idioma'] == 'en') {
			echo "Cookie en inglés";
		}
	} else {
		echo "Sin cookie. Primer acceso.";
	}
	?>
</body>


</html>