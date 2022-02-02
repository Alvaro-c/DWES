// Función que se llama cuando se envía el form
function login() {

    // Se recogen los valores de user y pass
    let user = document.getElementById('usuario').value;
    let pass = document.getElementById('clave').value;
    // Se llama a la función que los comprueba con el sv
    comprobarUser(user, pass);

    return false;
}

// Esta función llama al sv de manera síncrona, envía user y pass por POST para compararlo con la BBDD
// El script de PHP y de BBDD están copiados del ejercicio del Tema 4, el que comprueba el login está ligeramente modificado
function comprobarUser(user, pass) {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let resul = this.response;

            // If para comprobar si se ha obtenido una respuesta positiva o negativa del sv.

            resul == 1 ? resul = true : resul = false;

            // Segun el if, se muestra un alert u otro.
            if (resul) {
                alert("Usuario y clave correctos");
            } else {

                alert("Error: Usuario o clave INCORRECTOS");
            }

        }
    }

    xhttp.open("POST", `ejercicio6.php`, false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`usuario=${user}&clave=${pass}`);

}