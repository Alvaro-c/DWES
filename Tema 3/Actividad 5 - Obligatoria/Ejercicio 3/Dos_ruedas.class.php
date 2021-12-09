<?php

// Clase Dos_ruedas
class Dos_ruedas extends Vehiculo {

    private $cilindrada;

    // Añade el peso pasado por parámetro al peso total del objeto
    public function poner_gasolina($litros) {
        $this->setPeso($this->getPeso() + $litros);
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
