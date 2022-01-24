<header>
    Usuario: <?php echo $_SESSION['usuario']['Correo'] ?>
    <a href="categorias.php">Home</a>
    <a href="preferencias.php">Preferencias</a>

    <?php
    if ($_SESSION['usuario']['Rol'] == 1) {
        echo "<a href='zonaadmin.php'>Administración</a>";
    } else if ($_SESSION['usuario']['Rol'] == 2) {
        echo "<a href='zona_pedidos.php'>Gestion de productos y pedidos</a>";
    }
    ?>
    <a href="carrito.php">Ver carrito</a>
    <a href="logout.php">Cerrar sesión</a>
</header>
<hr>