<?php

abstract class Vehiculo {

    private $color;
    private $peso;
    const SALTO_DE_LINEA = "<br />";
    protected $numero_cambio_color = 0;

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

    public function ver_atributo(Vehiculo $objeto){
        echo "Tipo: Vehículo ". Vehiculo::SALTO_DE_LINEA;
        echo "Color: ". $objeto->getColor() . Vehiculo::SALTO_DE_LINEA . "
        Peso " . $objeto->getPeso(). " Kg ". Vehiculo::SALTO_DE_LINEA;

    }

}
