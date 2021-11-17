<?php

session_start();


if (isset($_SESSION['redirect2'])) {

    if ($_SESSION['redirect2'] == "empty") {

        echo '<p style="color:red"> Por favor, escribe una palabra </p>';
    } else if ($_SESSION['redirect2'] == "chars") {

        echo '<p style="color:red"> Por favor, escribe solo una palabra con letras y o números</p>';
    }

}

?>
<h2>Formulario 2</h2>
<fieldset>
    <form action="pagina-4.php" method="POST">
        <label for="word2">Escribe la misma palabla</label>
        <input type="text" name="word2" id="word2"> <br><br>
        <input type="submit" name="form2" value="Enviar">
    </form>

</fieldset>