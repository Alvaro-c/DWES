<!-- 
¿Cómo se trabaja con páginas multi-idiomas?
Distinguimos tres tipos de traducciones:
	a) Traducción de textos planos: 
		Se crea un fichero de texto por cada idioma, en el que tenemos como variables todas las palabras o frases planas que se necesitan escribir en la página-
	b) Traducción de textos que están insertados en una base de datos
		Se crean tantas tablas en otros idiomas como se tengan originalmente con los textos a traducir
	c) Traducción de textos mezclados con valores de variables
		Se utilizan los formatos predefinidos en cadenas de caracteres ejemplo:
			 printf("Tienes %1u documentos subidos, %2u abiertos",6,4);
		tiene por salida
			Tienes 6 documentos subidos, 4 abiertos.

En nuestro ejercicio solo tenemos texto plano. Utilizamos la opción a)
	Según el idioma de la cookie, incluimos un fichero u otro, en caso de que no haya ninguna cookie, cargamos el de español.
	Hemos de inscrustar código php en cada texto plano, para ello vamos a utilizar la sentencia: < ?= ... ;?> 
	Esta sentencia equivale a:
		< ?php
			echo ...;
		?>
-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	setcookie('Idioma', $_POST['idioma'], time() + 3600 * 24);
	header("Location: ".$_SERVER["PHP_SELF"]);
}
if (isset($_COOKIE['Idioma'])) {
	if ($_COOKIE['Idioma'] == 'es') {
		include ("lang_esp.php");
	}
	if ($_COOKIE['Idioma'] == 'en') {
		include ("lang_en.php");
	}
} else {
	include ("lang_esp.php");
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
		<p><?=$idioma;?></p>
		<input type="radio" name="idioma" value="en"/>
		<?=$radio_1;?><br/>
		<input type="radio" name="idioma" value="es"/>
		<?=$radio_2;?><br/>
		<input type="submit" value="<?=$enviar;?>" name="enviar"/>
	</form>
</body>
</html>