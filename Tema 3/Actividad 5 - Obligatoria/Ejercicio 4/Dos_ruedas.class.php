<?php

class Dos_ruedas extends Vehiculo {

    private $cilindrada;

    public function poner_gasolina($litros) {
        $this->setPeso($this->getPeso() + $litros);
    }

    public function getCilindrada() {
        return $this->cilindrada;
    }

    public function setCilindrada($cilindrada) {
        $this->cilindrada = $cilindrada;
        return $this;
    }

    public function anadir_persona($peso_persona) {

        $this->peso = $this->peso +  $peso_persona + 2;
    }
}
