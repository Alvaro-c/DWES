<?php

// Clase Vehiculo
class Vehiculo {

    private $color;
    private $peso;

    // Constructor con sus dos atributos
    public function __construct($color, $peso) {

        $this->color = $color;
        $this->peso = $peso;
    }

    // Método que muestra un mensaje por pantalla
    public function circula() {
        echo "El vehículo circula<br>";
    }

    // Método que añade el peso de la persona al objeto
    public function anadir_persona($peso_persona) {
        $this->peso = $this->peso + $peso_persona;
    }

    //getters y setters
    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setPeso($peso) {
        $this->peso = $peso;

        return $this;
    }
}
