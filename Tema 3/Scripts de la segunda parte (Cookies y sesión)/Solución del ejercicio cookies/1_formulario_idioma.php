<!-- 
Podemos abordar cualquier ejercicio de dos formas distintas:
	1) Analizando los posibles casos (entro por primera vez o por segunda vez, ya tengo una cookie creada o no, hemos dado al botón de enviar, etc...)
	2) Dividir el ejercicio en partes más sencillas (mostrar un formulario, crear una cookie, recuperar el valor de la cookie, etc...)

Comenzamos dividiendo el ejercicio en partes más sencillas.

El enunciado pide crear un formulario que cambie de idioma según el valor que demos a una cookie.
Analizando el ejercicio vemos que tiene dos partes que tenemos que resolver:
	a) Crear la cookie al enviar el formulario
	b) Cambiar de idioma según la cookie creada.

Vamos a centrarnos en crear la cookie al enviar el formulario.
Para ello, seguimos los siguientes pasos:
	1.- Creamos el formulario. Hemos de elegir entre checkbox, radio buttons, listados...
	2.- Cuando le demos a enviar, tenemos que crear la cookie. El formulario puede ir tanto con GET como POST, puesto que el idioma no es un dato sensible.
	3.- Comprobamos que hemos creado la cookie adecuadamente:
		o bien mirando las cookies en el navegador.
		o con un bloque específico de código que analice si se ha enviado o no la cookie.
-->

 <!DOCTYPE html>
<html>

<head>
	<title>Formulario de idioma</title>
	<meta charset="UTF-8">
</head>

<body>
<!--
En el action vamos a llamar a un script que nos genere la cookie.
Por tanto, ha de tener la siguiente intrucción: 
	setcookie('Idioma', $_POST['idioma'], time() + 3600 * 24);

-->
	<form name="input" action="1_cookie_idioma.php" method="post"> 
		<p>Idioma:</p>
		<input type="radio" name="idioma" value="en" />
		Inglés<br />
		<input type="radio" name="idioma" value="es" />
		Español<br />
		<input type="submit" value="Enviar" name="enviar" />
	</form>
<!--
Voy a comprobar si cada vez que accedo al formulario, detecto correctamente la cookie.
	La primera vez que accedemos, isset($_COOKIE['idioma']) es FALSE
	Las siguientes veces, si se ha creado adecuadamente, entonces tendrá algún idioma.
-->
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