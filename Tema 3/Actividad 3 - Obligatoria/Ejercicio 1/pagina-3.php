<?php

session_start();

if(isset($_SESSION['redirect2'])) {

    echo '<p style="color:red"> Por favor, introduce tus apellidos</p>';

}

?>

<fieldset>
    <form action="pagina-4.php" method="POST">
        <label for="name=">Apellidos: </label><input type="text" name="apellidos" id="apellidos"><br><br>
        <input type="submit" name="submit3" value="Enviar">
    </form>
</fieldset>