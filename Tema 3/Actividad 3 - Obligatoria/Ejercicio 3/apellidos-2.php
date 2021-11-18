<?php

session_start();


if(isset($_POST['surname']) && $_POST['surname'] != "") {

    $_SESSION['surname'] = $_POST['surname'];
    header('Location: index.php');

} else {
    
    $_SESSION['surname'] = "";
    header('Location: apellidos-1.php');
}



?>