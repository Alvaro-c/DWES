<?php
session_start();


if (isset($_SESSION['name']) && $_SESSION['name'] != "" ) {


    echo "El nombre es " . $_SESSION['name'];

    echo '<p><a href="index.php"> Volver a inicio</a></p>';

} else {

    if (isset($_SESSION['name']) && $_SESSION['name'] == "" ) {

        echo '<p style="color:red"> Escribe un nombre por favor</p>';
    }

?>

<h1>Escribe tu nombre</h1>

<fieldset>
    <form action="nombre-2.php" method="POST">
        <label for="name=">Nombre: </label><input type="text" name="name" id="name"><br><br>
        <input type="submit" name="submit1" value="Enviar">
    </form>
</fieldset>

<?php

echo '<p><a href="index.php"> Volver a inicio</a></p>';

}

?>