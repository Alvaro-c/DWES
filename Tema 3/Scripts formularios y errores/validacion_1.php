<!DOCTYPE html>
<html>

<head>
    <title>Validación de datos en el propio formulario</title>
    <meta charset="UTF-8">
</head>

<body>
    <?php
    if (isset($_POST['enviar'])) {
        $nombre = $_POST['nombre'];
        $modulos = $_POST['modulos'];
        print "Nombre: " . $nombre . "<br />";
        foreach ($modulos as $modulo) {
            print "Modulo: " . $modulo . "<br />";
        }
    } else {
    ?>
        <form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Nombre del alumno: <input type="text" name="nombre" /><br />
            <p>Módulos que cursa:</p>
            <input type="checkbox" name="modulos[]" value="DWES" />
            Desarrollo web en entorno servidor<br />
            <input type="checkbox" name="modulos[]" value="DWEC" />
            Desarrollo web en entorno cliente<br />
            <br />
            <input type="submit" value="Enviar" name="enviar" />
        </form>
    <?php
    }
    ?>
</body>

</html>