<!DOCTYPE html>
<html>

<head>
    <title>Validación de datos en el propio formulario</title>
    <meta charset="UTF-8">
</head>

<body>
    <?php
    // Esto se ejecuta si nombre y módulos están completos, no tiene misterio
    if (!empty($_POST['modulos']) && !empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $modulos = $_POST['modulos'];
        print "Nombre: " . $nombre . "<br />";
        foreach ($modulos as $modulo) {
            print "Modulo: " . $modulo . "<br />";
        }
    } else {
    ?>
        <form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Nombre del alumno:
            <input type="text" name="nombre" value="<?php
                                                    if (isset($_POST['nombre'])) {
                                                        echo $_POST['nombre'];
                                                    }
                                                    ?>" />
            <?php
            if (isset($_POST['enviar']) && empty($_POST['nombre'])) {
                echo "<span style='color:red'> &lt;-- Debe introducir un nombre.</span>";
            }
            ?><br />
            <p>Módulos que cursa:
                <?php
                // comprueba si los dos módulos están vacíos
                if (isset($_POST['enviar']) && empty($_POST['modulos'])) {
                    echo "<span style='color:red'> &lt;-- Debe escoger al menos un módulo.</span>";
                }
                ?>
            </p>
            <input type="checkbox" name="modulos[]" value="DWES" <?php
                                                                    // busca el valor en el array y en caso de que lo enuentre, añade el atributo checked = checked
                                                                    if (isset($_POST['modulos']) && in_array("DWES", $_POST['modulos'])) {
                                                                        echo 'checked="checked"';
                                                                    }
                                                                    ?> />
            Desarrollo web en entorno servidor
            <br />
            <input type="checkbox" name="modulos[]" value="DWEC" <?php
                                                                    // busca el valor en el array y en caso de que lo enuentre, añade el atributo checked = checked
                                                                    if (isset($_POST['modulos']) && in_array("DWEC", $_POST['modulos'])) {
                                                                        echo 'checked="checked"';
                                                                    }
                                                                    ?> />
            Desarrollo web en entorno cliente<br />
            <br />
            <input type="submit" value="Enviar" name="enviar" />
        </form>
    <?php
    }
    ?>
</body>

</html>