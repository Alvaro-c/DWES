<?php
//carga de clases
include('Animal.class.php');
//instanciar la clase Animal
$perro = new Animal("gris", 8);
$perro->comer();
$perro->moverse("París");
