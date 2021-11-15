<!-- Solución propuesta por HUGO -->

<?php
/*
	Existen 2 casos:
		a) Si accedemos al formulario:
			a.1) La primera vez. Por tanto, no hay una cookie creada todavía.
			a.2) Cualquier otra vez. Por tanto, ha de haber una cookie creada ya.
		b) Si hemos dado a "enviar" en el formulario
		*/
if (!empty($_POST['lang'])) {
	/* 
		Caso b): Hemos dado a enviar en el formulario, por tanto, ya sabemos el idioma elegido
			1.- Definimos una variable, $lenguaje, para mostrar el formulario en un idioma u otro
			2.- Creamos la cookie con el idioma seleccionado.
		*/
	$lenguaje = $_POST['lang'];
	setcookie('lenguaje', $_POST['lang'], time() + 3600 * 24);
} else {   /* Caso a), accedemos al formulario */
	if (!isset($_COOKIE['lenguaje'])) { // Caso a.1) La primera vez no hay cookies creadas, por tanto creo una en español y el $lenguaje se inicializa a español
		setcookie('lenguaje', 'es', time() + 3600 * 24);
		$lenguaje = "es";
	} else { // Caso a.2) Accedemos al formulario cualquier otra vez que no fuera la primera. Guardamos en $lenguaje el idioma que contiene la cookie.
		$lenguaje = $_COOKIE['lenguaje'];
	}
}
//Una vez anzalizados los casos, queda mostrar el formulario según el idioma seleccionado.
if ($lenguaje == "es") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Formulario de Lenguaje</title>
		<meta charset="UTF-8">
	</head>

	<body>
		<form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			Nombre del alumno:
			<input type="text" name="nombre" value="nombre" />
			<br />
			<p>Lenguaje:
			</p>
			<input type="radio" name="lang" value="en" />
			Inglés
			<br />
			<input type="radio" name="lang" value="es" />
			Español<br />
			<br />
			<input type="submit" value="Enviar" name="enviar" />
		</form>
	<?php
} else {
	?>
		<!DOCTYPE html>
		<html>

		<head>
			<title>Language Form</title>
			<meta charset="UTF-8">
		</head>

		<body>
			<form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				Name:
				<input type="text" name="nombre" value="nombre" />
				<br />
				<p>Language:
				</p>
				<input type="radio" name="lang" value="en" <?php
															if (isset($_POST['lenguaje']))
																$lenguaje = $_POST['lang'];
															?> />
				English
				<br />
				<input type="radio" name="lang" value="es" <?php
															if (isset($_POST['lenguaje']))
																$lenguaje = $_POST['lang'];
															?> />
				Spanish<br />
				<br />
				<input type="submit" value="Send" name="send" />
			</form>
		<?php

	}
		?>
		</body>

		</html>