<?php

// Opciones: 
// Primer acceso
// Segundo acceso
// 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie('color', $_POST['color'], time() + 36000 * 24);
    $color = $_POST['color'];
} else {

    $color = 'white';
}

if (!isset($_POST['color'])) {

    $color = 'white';
}




?>

<head>
    <title>Formulario color</title>
    <style>
        .red {
            background-color: red;
        }

        .green {
            background-color: green;
        }

        .blue {
            background-color: blue;
        }
    </style>

</head>

<body class="<?= $color ?>">


    <form name="input" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <p>Color:</p>

        <input type="radio" name="color" value="red" /> Rojo<br />
        <input type="radio" name="color" value="blue" />Azul<br />
        <input type="radio" name="color" value="green" />Verde<br />

        <input type="submit" value="Enviar" name="enviar" />
    </form>


</body>