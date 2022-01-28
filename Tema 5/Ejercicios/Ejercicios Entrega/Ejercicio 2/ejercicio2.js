
// Espero a que cargue la pagina y lanzo el listener del botón de envío
window.addEventListener('DOMContentLoaded', inicio);

// Evento para el envío de los números
function inicio(){
    document.getElementById('submit').addEventListener('click', suma);
}

// Petición asíncrona por POST
function suma() {

    // Recojo los números de los inputs del form
    let nums = getNums();
    let result;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.response;
            // Llamada a la función que escribe el resultado
            mostrarResult(result);
            
        }
    }
    xhttp.open("POST", `ejercicio2.php`);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send(`num1=${nums[0]}&num2=${nums[1]}`);

}

// Función que recoge los nums del form
function getNums() {

    let nums = [];
    nums[0] = document.getElementById('num1').value;
    nums[1] = document.getElementById('num2').value;

    return nums;
}

// Función que escribe el resultado
function mostrarResult(num) {
    document.getElementById('result').innerText = `Resultado: ${num}`;
}