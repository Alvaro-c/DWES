<?php 

session_start();
// Si el post no tiene el nombre, se rebota a pagina-1
if (!isset($_POST['name']) || $_POST['name'] == "") {

    $_SESSION['redirect1'] = "yes";
    header('Location: pagina-1.php');


} else {

    $_SESSION['name'] = $_POST['name'];
    header('Location: pagina-3.php');

}

