<?php
include "error_handler_log.php";
	// Si no existe la cookie sesion
	if(!isset($_COOKIE['sesion'])){
		// Guardamos un error
		manejadorErrores('001','No existe la cookie de sesión', $_SERVER['PHP_SELF'],4);
	}