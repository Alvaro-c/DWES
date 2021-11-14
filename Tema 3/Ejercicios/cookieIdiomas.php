<?php


if (!isset($_POST["idioma"])) {

    //setcookie('idioma', "es", time() + 3600 * 24);
?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="radio" id="es" name="idioma" value="es"><label for="es">Español</label>
        <input type="radio" id="en" name="idioma" value="en"><label for="en">Inglés</label>
        <br><br>
        Renderizado por defecto
        <br>
        <input type="submit" value="Enviar">

    </form>

    <?php

    // setcookie('idioma', $_POST["idioma"], time() + 3600 * 24);

} else if (isset($_POST["idioma"])) {

    setcookie('idioma', $_POST["idioma"], time() + 3600 * 24);

    if ($_COOKIE['idioma'] == 'es') {

    ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="radio" id="es" name="idioma" value="es" checked="checked"><label for="es">Español</label>
            <input type="radio" id="en" name="idioma" value="en"><label for="en">Inglés</label>
            <br><br>
            Renderizado español
            <br>

            <input type="submit" value="Enviar">

        </form>


    <?php

    } else if ($_COOKIE['idioma'] == 'en') {


    ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="radio" id="es" name="idioma" value="es"><label for="es">Español</label>
            <input type="radio" id="en" name="idioma" value="en" checked="checked"><label for="en">Inglés</label>
            <br><br>
            Renderizado ingles
            <br>
            <input type="submit" value="Submit">

        </form>


<?php


    }
}
