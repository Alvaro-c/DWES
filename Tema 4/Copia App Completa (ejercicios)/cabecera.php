<header>
    Usuario: <?php echo $_SESSION['usuario']['correo'] ?>
    <?php
    // Ejercicio 2
    // añadir la opción para el admin

    if ($_SESSION['usuario']['rol'] == 1) {
        ?><a href="zonaadmin.php">Administración</a><?php
    }
    ?>
    <a href="categorias.php">Home</a>
    <a href="carrito.php">Ver carrito</a>
    <a href="logout.php">Cerrar sesión</a>
</header>
<hr>