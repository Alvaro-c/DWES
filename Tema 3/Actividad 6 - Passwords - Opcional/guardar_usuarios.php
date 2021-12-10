<?php

session_start();

if(!isset($_SESSION['submit'])) {
   
    $_SESSION['userError'] = false;
    $_SESSION['passError'] = false;
    $_SESSION['userDupe'] = false;
}



?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>

    <form action="actividad6.php" method="post">
        <label for="usuario">Usuario: </label><input title="usuario" type="text" name="usuario" >
        <?php if($_SESSION['userError'] == true) echo '<span style="color: red" > Error con el nombre de usuario</span>' ?>
        <?php if($_SESSION['userDupe'] == true) echo '<span style="color: red" > El usuario ya existe</span>' ?>
        <br>
        <label for="password">Password: </label><input title="password" type="password" name="password">
        <?php if($_SESSION['passError'] == true) echo '<span style="color: red" > Error con la clave</span>' ?>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>

</body>

</html>