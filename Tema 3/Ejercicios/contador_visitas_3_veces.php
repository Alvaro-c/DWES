<?php
if (!isset($_COOKIE['visitas'])) {
	// primera vez, la variable está vacía, se crea con el nombre visitas
	setcookie('visitas', '1', time() + 3600 * 24); // Pillará todo como cadena
	echo "Bienvenido por primera vez";
} else {

	// aqui la cookie no está vacia, se incrementa el valor en uno y se sobreescribe la que tiene el cliente
	$visitas = (int) $_COOKIE['visitas'];
	$visitas++;

	if ($visitas > 3) {

		setcookie('visitas', $visitas, time() -  3600 * 24);
		return;
	}

	setcookie('visitas', $visitas, time() + 3600 * 24);
	echo "Bienvenido por $visitas vez";
}
