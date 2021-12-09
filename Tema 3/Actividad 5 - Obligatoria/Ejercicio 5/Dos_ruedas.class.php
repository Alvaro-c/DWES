<?php

use Dos_ruedas as GlobalDos_ruedas;

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

        $this->setPeso($this->getPeso() +  $peso_persona + 2);
    }

    public function ver_atributo(Vehiculo $objeto){

        //parent::ver_atributo($objeto);
        echo "Tipo: Dos Ruedas <br>"; 
        echo "Color: ". $objeto->getColor(). "<br>
        Peso " . $objeto->getPeso(). " Kg<br>
        Cilindrada: ". $objeto->getCilindrada(). "cc <br>";

    }
}
