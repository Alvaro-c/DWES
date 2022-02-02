function cerrarSesionUnaPagina() {
	/*cerrar sesión*/
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			/*cambiar visibilidades de las secciones*/
			document.getElementById("principal").style.display = "none";
			document.getElementById("login").style.display = "block";
			document.getElementById("contenido").innerHTML = "";
			alert("Sesion cerrada con éxito");
		}
	};
	xhttp.open("GET", "logout_json.php", true);
	xhttp.send();
	return false;
}

function login(formu) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText === "FALSE") {
				alert("Revise usuario y contraseña");
				// Ejercicio 4: Compruebo si el rol es 1 (admin) y si lo es, cargo el enlace correspondiente
			} else if (this.response == '1') {
				document.getElementById("principal").style.display = "block";
				document.getElementById("login").style.display = "none";
				/*ponemos el usuario devuelto en el hueco correspondiente*/
				document.getElementById("cab_usuario").innerHTML = "Usuario: " + usuario;
				let header = document.getElementById('cabecera');
				let linkAdmin = document.createElement('a');
				linkAdmin.innerText = 'Zona Admin';
				linkAdmin.href = '';
				linkAdmin.setAttribute("onclick","return zonaAdmin();");
				header.appendChild(linkAdmin);
				cargarCategorias();
				cargarCarrito();

			// Si no es admin, no se carga el enlace
			} else {

				document.getElementById("principal").style.display = "block";
				document.getElementById("login").style.display = "none";
				/*ponemos el usuario devuelto en el hueco correspondiente*/
				document.getElementById("cab_usuario").innerHTML = "Usuario: " + usuario;
				cargarCategorias();
				cargarCarrito();

			}
		}
	}
	var usuario = document.getElementById("usuario").value;
	var clave = document.getElementById("clave").value;
	var params = "usuario=" + usuario + "&clave=" + clave;
	xhttp.open("POST", "login_json.php", true);
	// envío con  POST requiere cabecera y cadena de parámetros
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(params);
	return false;
}