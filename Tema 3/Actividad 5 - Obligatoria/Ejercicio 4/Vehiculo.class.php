<?php

abstract class Vehiculo {

    private $color;
    private $peso;

    public function __construct($color, $peso) {

        $this->color = $color;
        $this->peso = $peso;
    }

    public function circula() {
        echo "El vehículo circula<br>";
    }

    abstract public function anadir_persona($peso_persona);

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

    public function ver_atributo(Vehiculo $objeto){
        echo "Tipo: Vehículo <br>";
        echo "Color: ". $objeto->getColor(). "<br> 
        Peso " . $objeto->getPeso(). " Kg <br>";

    }

}
