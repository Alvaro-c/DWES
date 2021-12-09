<?php

// Clase Vehiculo (abstracta)
abstract class Vehiculo {

    private $color;
    private $peso;
    const SALTO_DE_LINEA = "<br />"; // constante para poner saltos de línea
    protected $numero_cambio_color = 0; // Contador protegido para llevar la cuenta de las instancias

    // Constructor con sus dos atributos
    public function __construct($color, $peso) {

        $this->color = $color;
        $this->peso = $peso;
    }


    // Método que muestra un mensaje por pantalla
    public function circula() {
        echo "El vehículo circula<br>";
    }

    // Método que añade el peso de la persona al objeto (se implementa en clases hijo)
    abstract public function anadir_persona($peso_persona);

    //getters y setters
    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
        $this->numero_cambio_color = $this->numero_cambio_color + 1;

        return $this;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setPeso($peso) {

        $this->peso = $peso;

        return $this;
    }

    // Método que sustituye al método original del padre para mostrar todos los atributos del objeto
    public function ver_atributo(Vehiculo $objeto){
        echo "Tipo: Vehículo ". Vehiculo::SALTO_DE_LINEA;
        echo "Color: ". $objeto->getColor() . Vehiculo::SALTO_DE_LINEA . "
        Peso " . $objeto->getPeso(). " Kg ". Vehiculo::SALTO_DE_LINEA;

    }

}
