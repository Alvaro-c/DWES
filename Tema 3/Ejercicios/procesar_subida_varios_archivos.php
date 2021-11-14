<?php

$numArchivos = count($_FILES["fichero"]["name"]);


for ($i = 0; $i < $numArchivos; $i++) {

	$tam = $_FILES["fichero"]["size"][$i];
	if ($tam > 256 * 1024) {
		echo "<br>Demasiado grande";
		return;
	}

}

for ($i = 0; $i < $numArchivos; $i++) {

	echo "Nombre del fichero: " . $_FILES["fichero"]["name"][$i] . "<br>";
	echo "Tamaño del fichero: " . $_FILES["fichero"]["size"][$i]. "<br>";
	echo "Tipo del fichero: " . $_FILES["fichero"]["type"][$i]. "<br>";
	echo "Nombre temporal del fichero: " . $_FILES["fichero"]["tmp_name"][$i]. "<br>";
	echo "Código de error: " . $_FILES["fichero"]["error"][$i]. "<br>";

}




// $tam = $_FILES["fichero"]["size"][0];
// echo "Nombre del fichero: " . $_FILES["fichero"]["name"];
// echo "<br>Nombre temporal del fichero en sel servidor: " . $_FILES["fichero"]["tmp_name"];
// $res = move_uploaded_file($_FILES["fichero"]["tmp_name"], "subidos/" . $_FILES["fichero"]["name"]);
// if ($res) {
// 	echo "<br>Fichero guardado";
// } else {
// 	echo "<br>Error";
// }
