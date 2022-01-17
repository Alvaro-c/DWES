<header>
 Usuario: <?php echo $_SESSION['usuario']['Correo']?>
 <?php 
 if ($_SESSION['usuario']['Rol'] == 1){
     echo "<a href='zonaadmin.php'>Administración</a>";
 } 
 ?>
 <a href="categorias.php">Home</a>
 <a href="carrito.php">Ver carrito</a>
 <a href="preferencias.php">Preferencias</a>
 <a href="logout.php">Cerrar sesión</a>
 </header>
<hr>