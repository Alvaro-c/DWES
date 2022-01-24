function categorias() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			// crear lista
			var lista = document.createElement("ul");
			// meter los datos de la respuesta en un array
			var cats = JSON.parse(this.response);
			// para cada elemento del array 
			for (var i = 0; i < cats.length; i++) {
				//se crea un elemento ul con el campo  nombre 
				var elem = document.createElement("li");
				elem.innerHTML = cats[i]["nombre"];
				// se añade a la lista
				lista.appendChild(elem);
			}
			var body = document.getElementById("principal");
			// eliminar el contenido actual
			body.innerHTML = "";
			body.appendChild(lista);
		}
	};
	xhttp.open("GET", "datos_categorias_json.php", true);
	xhttp.send();
	// para que no se siga el link que llama a esta función
	return false;
}

function hora(){

	let horaHTML = document.getElementById('horaHTML');
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function (){

		if(this.readyState == 4 && this.status == 200) {
			horaHTML.innerHTML = this.response;
		}
	}

	xhttp.open("GET", "hora_servidor.php");
	xhttp.send();

	return false;
}