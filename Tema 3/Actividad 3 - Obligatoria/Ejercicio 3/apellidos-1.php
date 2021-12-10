<?php
session_start();


if (isset($_SESSION['surname']) && $_SESSION['surname'] != "" ) {


    echo "Los apellidos son " . $_SESSION['surname'];

    echo '<p><a href="guardar_usuarios.php"> Volver a inicio</a></p>';

} else {

    if (isset($_SESSION['surname']) && $_SESSION['surname'] == "" ) {

        echo '<p style="color:red"> Escribe tus apellidos por favor</p>';
    }

?>

<h1>Escribe tus apellidos</h1>

<fieldset>
    <form action="apellidos-2.php" method="POST">
        <label for="surname=">Apellidos: </label><input type="text" name="surname" id="surname"><br><br>
        <input type="submit" name="submit1" value="Enviar">
    </form>
</fieldset>

<?php

echo '<p><a href="guardar_usuarios.php"> Volver a inicio</a></p>';

}

?>