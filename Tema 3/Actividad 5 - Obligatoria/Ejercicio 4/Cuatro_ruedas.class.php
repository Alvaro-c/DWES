<?php

class Cuatro_ruedas extends Vehiculo
{

    private $numero_puertas;

    public function repintar($color) {
        $this->color = $color;
    }

    public function getNumero_puertas() {
        return $this->numero_puertas;
    }

    public function setNumero_puertas($numero_puertas) {

        $this->numero_puertas = $numero_puertas;
        return $this;

    }

    public function anadir_persona($peso_persona) {

        $this->setPeso($this->getPeso() + $peso_persona);
    }

    public function ver_atributo(Vehiculo $objeto) {

        echo "Tipo: Cuatro Ruedas <br>";
        echo "Color: " . $objeto->getColor() . "<br>
        Peso " . $objeto->getPeso() . " Kg<br>
        Número de puertas: " . $objeto->getNumero_puertas() . " <br>";

    }
}