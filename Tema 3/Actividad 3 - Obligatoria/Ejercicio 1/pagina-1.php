<?php

session_start();

if(isset($_SESSION['redirect1'])) {

    echo '<p style="color:red"> Por favor, introduce tu nombre</p>';

}

?>

<fieldset>
    <form action="pagina-2.php" method="POST">
        <label for="name=">Nombre: </label><input type="text" name="name" id="name"><br><br>
        <input type="submit" name="submit1" value="Enviar">
    </form>
</fieldset>


<?php 




?>