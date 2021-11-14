<!DOCTYPE html>
<html>

<head>
    <title>Validación de datos en el propio formulario</title>
    <meta charset="UTF-8">
</head>

<body>
    <?php
    if (isset($_POST['enviar'])) { // comprueba si hay algo en la var post, en la primera ejecución no habrá nada
        $nombre = $_POST['nombre'];
        $modulos = $_POST['modulos'];
        print "Nombre: " . $nombre . "<br />";
        foreach ($modulos as $modulo) {
            print "Modulo: " . $modulo . "<br />";
        }

        // print_r($_POST); Array ( [nombre] => Alvaro [modulos] => Array ( [0] => DWES [1] => DWEC ) [enviar] => Enviar )
    } else {
    ?>
        <form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- action = toma el valor de la pag actual en la que estamos, 
            así volverá a entrar en esta página para validar los datos. 
            la segunda vez ya con datos en la var POST -->

            Nombre del alumno: <input type="text" name="nombre" /><br />
            <p>Módulos que cursa:</p>
            <input type="checkbox" name="modulos[]" value="DWES" />
            <!-- Inicializado modulo como array, cuando se pasen por POST se irán a un array -->
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