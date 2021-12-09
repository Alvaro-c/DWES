<?php

// Clase cuatro ruedas
class Cuatro_ruedas extends Vehiculo {

    private $numero_puertas;

    // metodo que no se utiliza, implementado más adelante
    public function repintar($color) {
        // TODO
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