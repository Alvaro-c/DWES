// El script se ejecuta cuando se carga la página
window.addEventListener('DOMContentLoaded', inicio);


function inicio(){

    let json = getPedidos();
    // mostrarPedidos(json);

}



// Función que lanza petición asincrona al sv y loguea en consola la respuesta
function getPedidos() {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            
            let json =  JSON.parse(this.response);  
            mostrarPedidos(json);
        }
    }
    xhttp.open("GET", `../Ejercicio 3/ejercicio3.php`);
    xhttp.send();

}

// Función que muestra los pedidos en el HTML
function mostrarPedidos(datos) {

    let contenedor = document.getElementById('contenedor');
    let tabla = document.createElement('table');
    contenedor.appendChild(tabla);
    // Cabecera de la tabla
    tabla.innerHTML = `<tr><td>CodPed</td><td>Fecha</td><td>Enviado</td><td>Restaurante</td></tr>`;

    // El for escribe cada una de las tablas de JSON
    for (let i = 0; i < datos.length; i++) {
        
        let CodPed = datos[i].CodPed;
        let Fecha =  datos[i].Fecha;
        let Enviado =  datos[i].Enviado;
        let Restaurante =  datos[i].Restaurante;

        let row = document.createElement('tr');
        row.innerHTML =`<tr><td>${CodPed}</td><td>${Fecha}</td><td>${Enviado}</td><td>${Restaurante}</td>`;
        tabla.appendChild(row);

    }

}