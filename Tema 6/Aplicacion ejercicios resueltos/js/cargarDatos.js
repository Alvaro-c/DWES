function anadirProductos(formulario) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			alert("Producto añadido con éxito");
			// Cada vez que se añade un producto se actualiza el carrito y se muestra con la última info
			cargarCarrito();
			// Comentado para resolver el ejercicio 1
			// CargarCarrito(); 
		}
	};
	var params = "cod=" + formulario.elements['cod'].value + "&unidades=" + formulario.elements['unidades'].value;
	xhttp.open("POST", "anadir_json.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(params);
	return false;
}

function cargarCarrito() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			// Ejercicio 3: Cambio del elemento donde se dibuja el carrito al div lateral
			var contenido = document.getElementById("carrito");
			contenido.style.display = "display";
			contenido.innerHTML = "";
			var titulo = document.getElementById("titCarrito");
			titulo.innerHTML = "Carrito de la compra";
			try {
				var filas = JSON.parse(this.responseText);
				tabla = crearTablaCarrito(filas);
				contenido.appendChild(tabla);
				/*ahora el vínculo de procesar pedio*/
				var procesar = document.createElement("a");
				procesar.href = "#";
				procesar.innerHTML = "Realizar pedido";
				// Ejercicio 2: Se modifica la llamada a la función para que el usuario confirme el pedido
				procesar.onclick = function () { return confirmarPedido(); };
				contenido.appendChild(procesar);
			} catch (e) {
				var mensaje = document.createElement("p");
				mensaje.innerHTML = "Todavía no tiene productos";
				contenido.appendChild(mensaje);
			}

		}
	};
	xhttp.open("GET", "carrito_json.php", true);
	xhttp.send();
	return false;
}



function cargarCategorias() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cats = JSON.parse(this.responseText);
			var lista = document.createElement("ul");
			for (var i = 0; i < cats.length; i++) {
				var elem = document.createElement("li");
				vinculo = crearVinculoCategorias(cats[i].nombre, cats[i].codCat);
				elem.appendChild(vinculo);
				lista.appendChild(elem);
				
			}
			var contenido = document.getElementById("contenido");
			contenido.innerHTML = "";
			var titulo = document.getElementById("titulo");
			titulo.innerHTML = "Categorías";
			contenido.appendChild(lista);
			cargarCarrito();
		}
	};
	xhttp.open("GET", "categorias_json.php", true);
	xhttp.send();
	return false;
}

function cargarProductos(destino) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var prod = document.getElementById("contenido");
			var titulo = document.getElementById("titulo");
			titulo.innerHTML = "Productos";
			try {
				var filas = JSON.parse(this.responseText);
				var tabla = crearTablaProductos(filas);
				prod.innerHTML = "";
				prod.appendChild(tabla);
			} catch (e) {
				var mensaje = document.createElement("p");
				mensaje.innerHTML = "Categoría sin productos";
				prod.innerHTML = "";
				prod.appendChild(mensaje);
			}
		}
	};
	console.log(destino);
	xhttp.open("GET", destino, true);
	xhttp.send();
	return false;
}

// Ejercicio 2: La función muestra una ventana de confirmación. 
// Si se confirma, se llama a procesar pedido, sino, se vuelve a cargar el carrito.
function confirmarPedido() {

	if (confirm('¿Seguro que desea procesar el pedido?')) {

		procesarPedido();

	} else {
		cargarCarrito();
	}

	return false;

}

function crear_fila(campos, tipo) {
	var fila = document.createElement("tr");
	for (var i = 0; i < campos.length; i++) {
		var celda = document.createElement(tipo);
		celda.innerHTML = campos[i];
		fila.appendChild(celda);
	}
	return fila;
}

// Función para crear cada línea de la tabla restaurantes
function crear_forms(campos, tipo) {
	
	let fila = document.createElement("tr");
	let form = document.createElement('form');
	fila.appendChild(form);

	for (var i = 0; i < campos.length; i++) {
		let celda = document.createElement('td');
		fila.appendChild(celda);
		let input = document.createElement(tipo);
		input.value = campos[i];
		celda.appendChild(input);
		
	}
	
	return fila;
}

function crear_forms2(campos, tipo) {
	
	let  fila = document.createElement("tr");

	for (var i = 0; i < campos.length; i++) {
		let celda = document.createElement('td');
		fila.appendChild(celda);
		let input = document.createElement(tipo);
		input.value = campos[i];
		celda.appendChild(input);
		
	}

	return fila;
}

function crearFormulario(texto, cod, funcion) {
	var formu = document.createElement("form");
	var unidades = document.createElement("input");
	unidades.value = 1;
	unidades.name = "unidades";
	var codigo = document.createElement("input");
	codigo.value = cod;
	codigo.type = "hidden";
	codigo.name = "cod";
	var bsubmit = document.createElement("input");
	bsubmit.type = "submit";
	bsubmit.value = texto;
	formu.onsubmit = function () { return funcion(this); }
	formu.appendChild(unidades);
	formu.appendChild(codigo);
	formu.appendChild(bsubmit);
	return formu;
}

function crearTablaCarrito(productos) {
	var tabla = document.createElement("table");
	var cabecera = crear_fila(["Código", "Nombre", "Descripción", "Unidades", "Eliminar"], "th");
	tabla.appendChild(cabecera);
	for (var i = 0; i < productos.length; i++) {
		/*formulario*/
		formu = crearFormulario("Eliminar", productos[i]['CodProd'], 'test');
		fila = crear_fila([productos[i]['CodProd'], productos[i]['Nombre'], productos[i]['Descripcion'], productos[i]['unidades']], "td");
		celda_form = document.createElement("td");
		celda_form.appendChild(formu);
		fila.appendChild(celda_form);
		tabla.appendChild(fila);
	}
	return tabla;
}

function crearTablaProductos(productos) {
	var tabla = document.createElement("table");
	var cabecera = crear_fila(["Código", "Nombre", "Descripción", "Stock", "Comprar"], "th");
	tabla.appendChild(cabecera);
	for (var i = 0; i < productos.length; i++) {
		/*formulario*/
		formu = crearFormulario("Añadir", productos[i]['CodProd'], anadirProductos);
		fila = crear_fila([productos[i]['CodProd'], productos[i]['Nombre'], productos[i]['Descripcion'], productos[i]['Stock']], "td");
		celda_form = document.createElement("td");
		celda_form.appendChild(formu);
		fila.appendChild(celda_form);
		tabla.appendChild(fila);
	}
	return tabla;
}

// Función copiada de crearTablaProductos y adaptada para restaurantes
function crearTablaRestaurantes(restaurantes) {
	var tabla = document.createElement("table");
	var cabecera = crear_fila(["CodRes", "Correo", "Pais", "CP", "Ciudad", "Dirección", "Rol", "Actualizar"], "th");
	tabla.appendChild(cabecera);
	for (var i = 0; i < restaurantes.length; i++) {
		/*formulario*/
		// formu = crearFormulario("Actualizar", restaurantes[i]['CodRes'], actualizarRestaurantes);
		fila = crear_forms([restaurantes[i]['CodRes'], restaurantes[i]['Correo'], restaurantes[i]['Pais'], restaurantes[i]['CP'], restaurantes[i]['Ciudad'], restaurantes[i]['Direccion'], restaurantes[i]['Rol']], "input");
		// celda_form = document.createElement("td");
		// celda_form.appendChild(formu);
		// fila.appendChild(celda_form);
		tabla.appendChild(fila);
	}
	return tabla;
}

function crearVinculoCategorias(nom, cod) {
	var vinculo = document.createElement("a");
	var ruta = "productos_json.php?categoria=" + cod;
	vinculo.href = ruta;
	vinculo.innerHTML = nom;
	vinculo.onclick = function () { return cargarProductos(this); }
	return vinculo;
}

function eliminarProductos(formulario) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {

			alert("Producto eliminado con éxito");
			// Ejercicio 5: Eliminar el html del carrito y recargarlo para reflejar los cambios
			document.getElementById('carrito').innerHTML = '';
			cargarCarrito();

		}
	};
	var params = "cod=" + formulario.elements['cod'].value + "&unidades=" + formulario.elements['unidades'].value;
	xhttp.open("POST", "eliminar_json.php", true);
	//Send the proper header information along with the request
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(params);
	return false;
}

function procesarPedido() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var contenido = document.getElementById("contenido");
			contenido.innerHTML = "";
			var titulo = document.getElementById("titulo");
			titulo.innerHTML = "Estado del pedido";
			if (this.responseText == "TRUE") {
				contenido.innerHTML = "Pedido realizado";
				document.getElementById('carrito').innerHTML = '';
			} else {
				contenido.innerHTML = "Error al procesar el pedido";
			}
		}
	};
	xhttp.open("GET", "procesar_pedido_json.php", true);
	xhttp.send();
	return false;
}

function getCategoria(codProd) {


	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function categoria() {
		if (this.readyState == 4 && this.status == 200) {
			respuesta = JSON.parse(this.responseText)[0].CodCat;

		}
	};
	xhttp.open("GET", `getCategoria.php?CodProd=${codProd}`, true);
	xhttp.send();
	return respuesta;

}


// Nuevo Ejercicio 6: Función que carga el menú de admin

function zonaAdmin() {

	let contenido = document.getElementById('contenido');
	contenido.innerHTML = '';

	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			
			var res = document.getElementById("contenido");
			var titulo = document.getElementById("titulo");
			titulo.innerHTML = "Restaurantes";
			let filas = JSON.parse(this.responseText);
			var tabla = crearTablaRestaurantes(filas);
				res.innerHTML = "";
				res.appendChild(tabla);

		}

	}

	xhttp.open('GET', 'restaurantes_json.php');
	xhttp.send();

return false;

}

function actualizarRestaurantes(){

	return false;
}