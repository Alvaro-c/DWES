<?php 

session_start();

// Si el post no tiene los apellidos, se rebota a pagina-3
if (!isset($_POST['apellidos']) || $_POST['apellidos'] == "") {

    $_SESSION['redirect2'] = "yes";
    header('Location: pagina-3.php');


} else {
    
    $_SESSION['apellidos'] = $_POST['apellidos'];
    header('Location: pagina-5.php');

}
