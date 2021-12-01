<?php
//carga de la clase
include('Animal.class.php');
//instanciar la clase Animal
$perro1 = new Animal("rojo",10);
//instanciar la clase Animal
$perro2 = new Animal("gris",5);
//instanciar la clase Animal
$perro3 = new Animal("negro",15);
//instanciar la clase Animal
$perro4 = new Animal("blanco",8);
//llamada al método estático
echo "Número de animales que se han instanciado:".Animal::getContador();
