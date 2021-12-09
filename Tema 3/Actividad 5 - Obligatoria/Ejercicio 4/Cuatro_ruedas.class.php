<?php

// Clase Cuatro_ruedas
class Cuatro_ruedas extends Vehiculo
{

    private $numero_puertas;

    // método que cambia el color del objeto
    public function repintar($color) {
        $this->color = $color;
    }

    // getters y setters
    public function getNumero_puertas() {
        return $this->numero_puertas;
    }

    public function setNumero_puertas($numero_puertas) {

        $this->numero_puertas = $numero_puertas;
        return $this;

    }

    // Método que añade el peso de una persona al peso que ya tiene el objeto
    public function anadir_persona($peso_persona) {

        $this->setPeso($this->getPeso() + $peso_persona);
    }

    // Método que sustituye al método original del padre para mostrar todos los atributos del objeto
    public function ver_atributo(Vehiculo $objeto) {

        echo "Tipo: Cuatro Ruedas <br>";
        echo "Color: " . $objeto->getColor() . "<br>
        Peso " . $objeto->getPeso() . " Kg<br>
        Número de puertas: " . $objeto->getNumero_puertas() . " <br>";

    }
}