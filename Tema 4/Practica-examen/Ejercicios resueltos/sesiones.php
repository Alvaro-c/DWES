<?php
function comprobar_sesion(){
	session_start();
	if(!isset($_SESSION['usuario'])){	
		header("Location: login.php?redirigido=true");
	}		
}

function comprobar_admin(){
	if($_SESSION['usuario']['Rol']!=1){	
		header("Location: categorias.php");
	}		
}

function comprobar_gestion() {
    if($_SESSION['usuario']['Rol'] == 2 && $_SESSION['usuario']['Rol'] == 1){
        header("Location: categorias.php");
    }
}
