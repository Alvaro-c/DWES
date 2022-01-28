// Cargarel script cuando todo el DOM se cargue
window.addEventListener('DOMContentLoaded', inicio);

function inicio() {

    // Añadir eventListener al botón para procesar la solicitud
    document.getElementById('submit').addEventListener('click', enviar);

    // Envío las diferentes pediciones
    function enviar() {

        // Recojo el input y lo preparo para enviar al sv.
        let rawData = document.getElementById('nums').value;
        let array = prepareArray(rawData);
        // Muestro los números introducidos
        mostrarArray(array);

        // Una llamada por cada operación alternando síncronas y asíncronas
        peticion(array, 'recorrido', 'rec', false);
        peticion(array, 'media', 'med', true);
        peticion(array, 'moda', 'mod', false);
        peticion(array, 'varianza', 'var', true);
        peticion(array, 'desviacion', 'des', false);
        peticion(array, 'cuartiles', 'cua', true);


    }

    // Funciones que transforman el array y lo muestran
    let prepareArray = (raw) => raw.split(',');
    function mostrarArray (array) {
        document.getElementById('arrayNums').innerText = `Los números introducidos son ${array}`;
    }

    // Esta función envía un array, una operación, el id del elemento HTML donde se va a mostrar y si la conexión es síncrona o asíncrona
    function peticion(array, operacion, id, comm) {

        let xhttp = new XMLHttpRequest;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(id).innerText = `${this.response}`;
            }
        }

        xhttp.open('POST', '_ejercicio 03.php', comm);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(`operacion=${operacion}&array=${array}`);
    }

}