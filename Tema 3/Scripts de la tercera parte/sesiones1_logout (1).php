<?php
	session_start();
	if(!isset($_SESSION['usuario'])){	
		header("Location: sesiones1_login.php?redirigido=true");
	}else{	
		session_destroy();
		setcookie(session_name(), 123, time() - 1000); // eliminar la cookie
		header("Location: sesiones1_login.php");
	}