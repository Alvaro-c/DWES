<?php

session_start();

if (isset($_SESSION['redirect1'])) {

    if ($_SESSION['redirect1'] == "empty") {

        echo '<p style="color:red"> Por favor, escribe una palabra </p>';
    } else if ($_SESSION['redirect1'] == "chars") {

        echo '<p style="color:red"> Por favor, escribe solo una palabra con letras y o números</p>';
    } else if ($_SESSION['match'] == false) {

        echo '<p style="color:red"> Las palabras son diferentes</p>';
    }

}

?>
<h2>Formulario 1</h2>
<fieldset>
    <form action="pagina-2.php" method="POST">
        <label for="word1">Escribe una palabla</label>
        <input type="text" name="word1" id="word1"> <br><br>
        <input type="submit" name="form1" value="Enviar">
    </form>

</fieldset>