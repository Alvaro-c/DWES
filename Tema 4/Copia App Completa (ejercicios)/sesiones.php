<?php
function comprobar_sesion(){
	session_start();
	if(!isset($_SESSION['usuario'])){	
		header("Location: login.php?redirigido=true");
	}		
}

function comprobar_admin() {

	if($_SESSION['usuario']['rol'] != 1) {
		header("Location: categorias.php");
	}

}