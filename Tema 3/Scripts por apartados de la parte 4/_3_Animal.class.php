<?php
class Animal
{
    // Declaración de atributos
    private $color = "gris";
    public $peso = 10;
    private $tab_atributos = array();
    public function __construct($color, $peso) // Constructor
    //que solicita 2 argumentos.
    {
        echo 'Llamada al constructor.<br>';
        $this->color = $color; // Inicialización del color.
        $this->peso = $peso; // Inicialización del peso.
    }
    //métodos mágicos
    public function __get($nombre)
    {
        echo "__get <br>";
        if (isset($this->tab_atributos[$nombre]))
            return $this->tab_atributos[$nombre];
    }
    public function __set($nombre, $valor)
    {
        echo "__set <br>";
        $this->tab_atributos[$nombre] = $valor;
    }
    public function __isset($nombre)
    {
        return isset($this->tab_atributos[$nombre]);
    }
    public function __call($nombre, $argumentos)
    {
        echo "El método " . $nombre . " no es accesible. Sus argumentos
eran los siguientes :" . implode(",", $argumentos) . "<br>";
        if (method_exists($this, $nombre)) {
            $this->$nombre(implode(",", $argumentos));
        }
    }
    public static function __callStatic($nombre, $argumentos)
    {
        echo "El método estático " . $nombre . " no es accesible.
Sus argumentos eran los siguientes :" . implode(",", $argumentos)
            . "<br>";
        if (method_exists(__CLASS__, $nombre)) {
            echo __CLASS__ . '::' . $nombre . ' < br > ';
            self::$nombre(implode(",", $argumentos));
        }
    }
    //método público
    public function comer()
    {
        echo "Método público comer() <br>";
    }
    //método privado
    private function moverse($lugar)
    {
        echo "Método privado moverse() <br>";
    }
}
