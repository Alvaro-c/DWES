<?php

session_start();


$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$pass = '';
$bd = new PDO($cadena_conexion, $usuario, $pass);
$array = array();

if(!isset($_POST['cod']) && !isset($_POST['submit'])) {

    header('Location: sesiones1_login.php');

}

if (isset($_POST['cod'])) {

    $cod = $_POST['cod'];
    $_SESSION['cod'] = $cod;

    try {
        $sql = "SELECT nombre, clave, rol FROM usuarios  WHERE codigo = '" . $cod . "'";
        $usuarios = $bd->query($sql);
        $array = $usuarios->fetchAll();
    } catch (PDOException $e) {
        echo 'Error con la base de datos: ' . $e->getMessage();
    }

    $name = $array[0][0];
    $rol = $array[0][2];
    $clave = $array[0][1];
}


if (isset($_POST['submit'])) {

    $newClave = $_POST['newClave'];
    $newRol = $_POST['newRol'];
    $cod = $_SESSION['cod'];

    $sql = "UPDATE usuarios SET clave = $newClave, rol = $newRol  WHERE codigo = $cod";
    $bd->query($sql);


    try {
        $sql = "SELECT nombre, clave, rol FROM usuarios  WHERE codigo = '" . $cod . "'";
        $usuarios = $bd->query($sql);
        $array = $usuarios->fetchAll();
    } catch (PDOException $e) {
        echo 'Error con la base de datos: ' . $e->getMessage();
    }

    $name = $array[0][0];
    $rol = $array[0][2];
    $clave = $array[0][1];


}


?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="name">Codigo: </label><input type="text" value="<?php echo $cod; ?>" disabled><br>
    <label for="name">Nombre: </label><input type="text" value="<?php echo $name; ?>" disabled><br>
    <label for="rol">Rol: </label><input type="text" value="<?php echo $rol; ?>" name="newRol"><br>
    <label for="clave">Clave: </label><input type="text" value="<?php echo $clave; ?>" name="newClave"><br>
    <input type="submit" name="submit">
</form>

<br><br><a href="sesiones1_principal.php"> Principal <a>


