<?php

class Dos_ruedas extends Vehiculo {

    private $cilindrada;

    public function poner_gasolina() {
        // TODO
    }

    public function getCilindrada(){
        return $this->cilindrada; 
    }

    public function setCilindrada($cilindrada) {
        $this->cilindrada = $cilindrada; 
        return $this;
    }
}
