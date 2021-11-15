<!-- 
2.- Idea: cambiando cada texto plano independientemente.
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
	<form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<!-- Bloque para el texto "Idioma" -->
			<?php
				if (isset($_COOKIE['Idioma'])) {
					if ($_COOKIE['Idioma'] == 'es') {
						echo "<p>Idioma:</p>";
					}
					if ($_COOKIE['Idioma'] == 'en') {
						echo "<p>Language:</p>";
					}
				} else {
					echo "<p>Idioma:</p>";	
				}
			?>
		<input type="radio" name="idioma" value="en"/>
				
		<!-- Bloque para la opción Inglés -->
			<?php
				if (isset($_COOKIE['Idioma'])) {
					if ($_COOKIE['Idioma'] == 'es') {
						echo "Inglés<br/>";
					}
					if ($_COOKIE['Idioma'] == 'en') {
						echo "English<br/>";
					}
				} else {
					echo "Inglés<br/>";	
				}
			?>				
		<input type="radio" name="idioma" value="es"/>

		<!-- Bloque para la opción Español -->
			<?php
				if (isset($_COOKIE['Idioma'])) {
					if ($_COOKIE['Idioma'] == 'es') {
						echo "Español<br/>";
					}
					if ($_COOKIE['Idioma'] == 'en') {
						echo "Sapnish<br/>";
					}
				} else {
					echo "Español<br/>";	
				}
			?>
		<input type="submit" value="Enviar" name="enviar"/>
	</form>
</body>
</html>