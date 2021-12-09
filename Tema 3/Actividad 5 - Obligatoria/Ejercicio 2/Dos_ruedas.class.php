<?php

// Clase Dos_ruedas
class Dos_ruedas extends Vehiculo {

    private $cilindrada;

    // metodo que no se utiliza, implementado más adelante
    public function poner_gasolina() {
        // TODO
    }

    // getters y setters
    public function getCilindrada(){
        return $this->cilindrada; 
    }

    public function setCilindrada($cilindrada) {
        $this->cilindrada = $cilindrada; 
        return $this;
    }
}
