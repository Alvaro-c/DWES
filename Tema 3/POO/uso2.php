<?php
//carga de la clase
include('Animal.class.php');

//instanciar la clase Animal
$perro = new Animal("rojo", 1);

//leer el peso
echo "El peso del perro es:".$perro->getPeso()." kg<br>";

//añadir un kilo al perro
$perro->añadir_un_kilo();

//leer el peso
echo "El peso del perro es:".$perro->getPeso()." kg<br>";
//actualizar el peso del perro
$perro->setPeso(15);
//leer el peso
echo "El peso del perro es:".$perro->getPeso()." kg<br>";


// $gato = new Animal();
// //actualizar el peso del gato
// $gato->setPeso(5);
// //leer el peso
// echo "El peso del gato es: ".$gato->getPeso()." kg<br>";
// //actualizar el color del gato
// $gato->setColor("blanco");
// //leer el color
// echo "El color del gato es: ".$gato->getColor()."<br>";

echo "<br><br>";
//instanciar la clase Animal
$gato = new Animal("rojo", 1);
//actualizar el peso del gato
$gato->setPeso(8);
//leer el peso
echo "El peso del gato es:".$gato->getPeso()." kg<br>";
//actualizar el color del gato
$gato->setColor("negro");
//leer el color
echo "El color del gato es:".$gato->getColor()."<br>";
//instanciar la clase Animal
$pez = new Animal("rojo", 1);
//actualizar el peso del pez
$pez->setPeso(1);
//leer el peso
echo "El peso del pez es:".$pez->getPeso()." kg<br>";
//actualizar el color del pez

$pez->setColor("blanco");
//leer el color
echo "El color del pez es:".$pez->getColor()."<br><br>";
//el gato come al pez
$gato->comer_animal($pez);
//leer el peso
echo "El nuevo peso del gato es:".$gato->getPeso()." kg<br>";
//leer el peso
echo "El peso del pez es:".$pez->getPeso()." kg<br>";
//leer el color
echo "El color del pez es:".$pez->getColor()."<br><br>";


// llamar a constructor especial estático
$perro2 = Animal::crea("Marrón", 14);