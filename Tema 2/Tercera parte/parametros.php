<HTML>

<HEAD>
    <TITLE>Trabajando con Funciones</TITLE>
</HEAD>

<BODY>
    <H2>Funciones de Usuario</H2>
    <?php
    $mifinal = 0;
    function cuentaAtras($inicio, &$fin, $mensaje = "¡ Y cero !")
    {
        for ($i = $inicio; $i > $fin; $i--) {
            echo $i, "...<br>";
        }

        $fin = $fin + 2;
        echo $mensaje;
    }
    ?>
    <TABLE>
        <tr>
            <td>
                <?php
                // $mifinal vale 0 
                cuentaAtras(6, $mifinal);
                // $mifinal vale 2
                ?>
            </td>
            <td>
                <?php
                // $mifinal vale 2
                cuentaAtras(8, $mifinal, "¡ Terminé en " . $mifinal . " !");
                // $mifinal vale 4
                ?>
            </td>
    </TABLE>
</BODY>

</HTML>