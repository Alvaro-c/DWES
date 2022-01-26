// Cuando la ventana ha cargado, se llama a la función que hace las peticiones
window.addEventListener('DOMContentLoaded', inicio);

// Petición al sv de un num aleatorio
function inicio() {
    let num;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            num = this.response;
            mostrarNum(num);
        }
    }
    xhttp.open("GET", "ejercicio1.php");
    xhttp.send();
}

// Función para mostrar el num
function mostrarNum(num){
    document.getElementById('num').innerText = num;
}
