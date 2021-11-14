<?php


$agenda = array();
$agenda["Alvaro"] = "email@email.com";
$agenda["Pepe"] = "email2@email.com";
$agenda["Juan"] = "email3@email.com";
$agenda["Carlos"] = "email4@email.com";


function addContact(&$agenda)
{
    // Si post tiene datos y el correo no está vacío
    if (!empty($_POST) && !empty($_POST["email"])) {

        $agenda[$_POST["name"]] = $_POST["email"];
    }
}

function printArray($array)
{

    foreach ($array as $name => $email) {

        echo "$name : $email <br>";
    }
}

// devuelve true si está repetido, false si no está repetido
function isDupe($array, $newName)
{

    foreach ($array as $name => $email) {
        // Nombre nuevo coincide con uno existente
        if ($name == $newName) return true;
    }
    return false;
}

// Primera carga
if (!isset($_POST["submit"])) {


?>

    <!-- Formulario HTML por primera vez  -->

    <h1>Actividad 2</h1>
    <h2>Formulario</h2>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name"> Introduce tu nombre: </label>
        <input id="name" name="name" type="text">

        <?php
        // Advertencia si está vacío el nombre
        if (isset($_POST["submit"]) && empty($_POST["name"])) {
            echo "<span style='color:red'> Introduce un nombre por favor</span>";
        }

        ?>
        <br>
        <label for="email"> Introduce tu email: </label>
        <input id="email" name="email" type="text"><br><br>

        <input type="submit" value="submit" name="submit">
    </form>


    <br><br>
    <hr><br><br>

    <h2>Empleados</h2>
    <?php printArray($agenda); ?>

<?php


    // El POST ya está seteado
} else if (isset($_POST["submit"])) {

    // Se comprueba si el nombre existe y si no existe y hay un email, se añade al array
    if (!isDupe($agenda, $_POST["name"]) && !empty($_POST["email"])) {

        addContact($agenda);
    } else if (isDupe($agenda, $_POST["name"]) && !empty($_POST["email"])) {

        $agenda[$_POST["name"]] = $_POST["email"];
    } else if (isDupe($agenda, $_POST["name"]) && empty($_POST["email"])) {

        unset($agenda[$_POST["name"]]);
    }

?>

    <h1>Actividad 2</h1>
    <h2>Formulario</h2>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name"> Introduce tu nombre: </label>
        <input id="name" name="name" type="text">

        <?php
        // Advertencia si está vacío el nombre
        if (isset($_POST["submit"]) && empty($_POST["name"])) {
            echo "<span style='color:red'> Introduce un nombre por favor</span>";
        }

        ?>
        <br>
        <label for="email"> Introduce tu email: </label>
        <input id="email" name="email" type="text">

        <br><br>

        <input type="submit" value="submit" name="submit">
    </form>


    <br><br>
    <hr><br><br>

    <h2>Empleados</h2>

    <?php printArray($agenda); ?>

<?php


}


?>