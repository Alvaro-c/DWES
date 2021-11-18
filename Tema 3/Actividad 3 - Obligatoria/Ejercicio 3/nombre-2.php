<?php

session_start();


if(isset($_POST['name']) && $_POST['name'] != "") {

    $_SESSION['name'] = $_POST['name'];
    header('Location: index.php');

} else {
    
    $_SESSION['name'] = "";
    header('Location: nombre-1.php');
}



?>