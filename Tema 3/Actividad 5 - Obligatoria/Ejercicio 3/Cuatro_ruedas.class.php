<?php

// Clase Cuatro_ruedas
class Cuatro_ruedas extends Vehiculo {

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

    
}