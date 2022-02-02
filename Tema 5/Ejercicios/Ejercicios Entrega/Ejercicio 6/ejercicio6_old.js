// Este ejemplo no funciona porque no guarda el return de la función comprobarUser por algún motivo desconocido.
// La solución a este ejercicio es el otro scritp de la misma carpeta

// Script principal
function login() {

    let user = document.getElementById('usuario').value;
    let pass = document.getElementById('clave').value;
    let resul = comprobarUser(user, pass);
    
    if (resul) {
        alert("Usuario y clave correctos");
    } else {

        alert("Error: Usuario o clave INCORRECTOS");
    }

    return false;
}


function comprobarUser(user, pass) {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let resul = this.response;

            resul == 1 ? resul = true : resul = false;

            return resul;
        }
    }

    xhttp.open("POST", `ejercicio6.php`, false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`usuario=${user}&clave=${pass}`);

}