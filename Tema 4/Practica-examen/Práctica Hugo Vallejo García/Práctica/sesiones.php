<?php
function comprobar_sesion()
{
	session_start();
	if (!isset($_SESSION['usuario'])) {
		header("Location: login.php?redirigido=true");
	}
}

function comprobar_admin()
{
	if ($_SESSION['usuario']['Rol'] != 1) {
		header("Location: categorias.php");
	}
}

// Comprueba si el rol del usuario actual es el 2 (Responsable o gestor)
function comprobar_responsable()
{
	if ($_SESSION['usuario']['Rol'] != 2) {
		header("Location: categorias.php");
	}
}
