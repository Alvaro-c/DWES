<HTML> 
  <HEAD>
    <TITLE>Variables con Cadenas de caracteres</TITLE>
  </HEAD>
  <BODY>
    <CENTER>
    <H2>Trabajando con Cadenas de caracteres</H2> 
    <?php
    $lenguaje="PHP";
    $ver="v8";
    echo "<B>Estamos trabajando con $lenguaje ($ver) </B><BR><BR>"; // comillas dobles para introducir variables dentro de un string
    echo 'La variable $lenguaje contiene: '; // comillas simples para mostrar solo strings
    echo $lenguaje;
    echo "<BR>";
    echo 'La variable $ver contiene: ';
    echo $ver;
    ?>
    </CENTER>
  </BODY>
</HTML>