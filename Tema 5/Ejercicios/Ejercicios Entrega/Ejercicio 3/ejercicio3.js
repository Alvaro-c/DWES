
// Función que lanza petición asincrona al sv y loguea en consola la respuesta
function getPedidos() {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result =  JSON.parse(this.response);  
            console.log(result);
           
        }
    }
    xhttp.open("GET", `ejercicio3.php`);
    xhttp.send();

}