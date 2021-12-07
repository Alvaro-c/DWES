<?php

class Coche extends Cuatro_ruedas {

    private $numero_cadenas_nieve;

    public function anadir_cadenas_nieve($num) {
        $this->numero_cadenas_nieve = $this->numero_cadenas_nieve + $num;
    }

    public function quitar_cadenas_nieve($num) {
        // TODO
    }

    public function getNumero_cadenas_nieve() {
        return $this->numero_cadenas_nieve;
    }

    public function setNumero_cadenas_nieve($numero_cadenas_nieve) {
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
        return $this;
    }

    public function ver_atributo(Vehiculo $objeto){
        
        echo "Tipo: Coche <br>";
        echo "Color: ". $objeto->getColor(). "<br>
        Peso " . $objeto->getPeso(). " Kg<br>
        Número de puertas: ". $objeto->getNumero_puertas(). " <br>
        Nº Cadenas de nieve: " . $objeto->getNumero_cadenas_nieve() . " <br>";

    }
}
