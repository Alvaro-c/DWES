window.addEventListener('DOMContentLoaded', inicio);



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


function mostrarNum(num){
    document.getElementById('num').innerText = num;
}
