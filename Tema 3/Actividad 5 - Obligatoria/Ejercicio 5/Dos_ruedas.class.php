<?php

use Dos_ruedas as GlobalDos_ruedas;

class Dos_ruedas extends Vehiculo {

    private $cilindrada;

    // Añade el peso pasado por parámetro al peso total del objeto
    public function poner_gasolina($litros) {
        $this->setPeso($this->getPeso() + $litros);
    }

    // getters y setters
    public function getCilindrada() {
        return $this->cilindrada;
    }

    public function setCilindrada($cilindrada) {
        $this->cilindrada = $cilindrada;
        return $this;
    }

    // Método que añade el peso de una persona al peso que ya tiene el objeto
    public function anadir_persona($peso_persona) {

        $this->setPeso($this->getPeso() +  $peso_persona + 2);
    }

    // Método que sustituye al método original del padre para mostrar todos los atributos del objeto
    public function ver_atributo(Vehiculo $objeto){

        //parent::ver_atributo($objeto);
        echo "Tipo: Dos Ruedas <br>"; 
        echo "Color: ". $objeto->getColor(). "<br>
        Peso " . $objeto->getPeso(). " Kg<br>
        Cilindrada: ". $objeto->getCilindrada(). "cc <br>";

    }
}
