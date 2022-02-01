<!DOCTYPE html>
<html>

<head>
	<title>Formulario de login</title>
	<meta charset="UTF-8">
	<script type="text/javascript" src="js/cargarDatos.js"></script>
	<script type="text/javascript" src="js/sesion.js"></script>
	<style>
		/*Ejercicio 3: Estilo para que el carrito aparezca siempre en un lateral*/
		* {
			box-sizing: border-box;
		}

		#main {
			display: grid;
			grid-template-columns: 2fr 1fr;
		}

		#contCarrito {

			border: solid 1px black;
			padding: 1%;
			margin-right: 4%;
			box-shadow: 1px 1px 1px 1px grey;
			border-radius: 5%;
		}

	</style>
</head>

<body>
	<section id="login">
		<form onsubmit="return login()" method="POST">
			Usuario <input id="usuario" type="text">
			Clave <input id="clave" type="password">
			<input type="submit">
		</form>
	</section>
	<section id="principal" style="display:none">
		<header id="cabecera">
			<span id="cab_usuario"></span>
			<a href="#" onclick="return cargarCategorias();">Home</a>
			<a href="#" onclick="return cargarCarrito();">Carrito</a>
			<a href="#" onclick="return cerrarSesionUnaPagina();">Cerrar sesión</a>
		</header>
		<hr>
		<h2 id="titulo"></h2>
		<div id="main">
			<section id="contenido">
			</section>

			<div id="contCarrito">
				<h2 id="titCarrito"></h2>
				<section id="carrito">

				</section>
			</div>
		</div>

	</section>



	</section>
</body>

</html>