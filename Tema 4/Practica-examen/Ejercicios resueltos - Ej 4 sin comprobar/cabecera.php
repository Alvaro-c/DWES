<header>
 Usuario: <?php echo $_SESSION['usuario']['Correo']?>
 <?php 
 if ($_SESSION['usuario']['Rol'] == 1){
     echo "<a href='zonaadmin.php'>Administración &nbsp;</a>";
 }
 // Si el usuario tiene rol 2 se muestra la gestión de productos y pedidos
 if ($_SESSION['usuario']['Rol'] == 2) {
     echo "<a href='zona_pedidos.php'>Gestión de productos y pedidos &nbsp;</a>";
 }

 ?>
 <a href="categorias.php">Home &nbsp;</a>
 <a href="carrito.php"> Ver carrito &nbsp;</a>
 <a href="preferencias.php"> Preferencias &nbsp;</a>
 <a href="logout.php"> Cerrar sesión &nbsp;</a>
 </header>
<hr>