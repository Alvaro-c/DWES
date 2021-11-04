<HTML>
<HEAD>
    <TITLE>Trabajando con Funciones</TITLE>
</HEAD>
<BODY>
    <H2>Funciones de Usuario</H2>
    <?php
    $inicio = 9;
    $final = 0;
    function cuentaAtras(){ 
        // variable global 
        global $final;
        // variable local
        $inicio = 7;
        // variable estática
        static $num = 0;
        for ($i = $inicio; $i > $final; $i--) {
            echo $i, "... <br>";
        }
        $num++;
        echo "¡ FIN -$num- !";
    }
    ?>
    <TABLE>
        <td>
            <?php
            cuentaAtras(); // $num vale 1
            ?> </td>
        <td>
            <?php
            cuentaAtras(); // $num vale 2
            ?>
        </td>
        </TR>
    </TABLE>
</BODY>
</HTML>