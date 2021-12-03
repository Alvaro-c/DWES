<?php
abstract class Animal
{
    // Declaración de atributos
    private $color = "gris";
    private $peso = 10;
    //constantes de clase
    const PESO_LIGERO = 5;
    const PESO_MEDIO = 10;
    const PESO_PESADO = 15;
    // Declaración de la variable estática $contador
    private static $contador = 0;
    public function __construct($color, $peso) // Constructor
    //que solicita 2 argumentos.
    {
        echo 'Llamada al constructor.<br>';
        $this->color = $color; // Inicialización del color.
        $this->peso = $peso; // Inicialización del peso.
        self::$contador = self::$contador + 1;
    }
    //accesos
    public function getColor()
    {
        return $this->color; //devuelve el color
    }
    public function setColor($color)
    {
        $this->color = $color; //escrito en el atributo color
    }
    public function getPeso()
    {
        return $this->peso; //devuelve el peso
    }
    public function setPeso($peso)
    {
        $this->peso = $peso; //escrito en el atributo peso
    }
    //métodos públicos
    public function comer_animal(Animal $animal_comido)
    {
        //el animal que come aumenta su peso tanto como
        //el del animal comido
        $this->peso = $this->peso + $animal_comido->peso;
        //el peso del animal comido y su color se restablecen a 0
        $animal_comido->peso = 0;
        $animal_comido->color = "";
    }

    public static function moverse()
    {
        echo "El animal se mueve.";
    }
    public function añadir_un_kilo()
    {
        $this->peso = $this->peso + 1;
    }
    // método estático que devuelve el valor del contador
    public static function getContador()
    {
        return self::$contador;
    }
    //código no aplicado por el método abstracto
    abstract public function respira();
}
