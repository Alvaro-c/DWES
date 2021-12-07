<?php

class Camion extends Cuatro_ruedas {

    private $longitud;

    // public function __construct($color, $peso, $num_puertas, $longitud) {
    //     $this->color = $color;
    //     $this->peso = $peso;
    //     $this->num_puertas = $num_puertas;
    //     $this->longitud = $longitud;
    // }

    public function anadir_remolque($longitud_remolque) {
        $this->longitud = $this->longitud + $longitud_remolque;
    }

    public function getLongitud() {
        return $this->longitud;
    }

    public function setLongitud($longitud) {
        $this->longitud = $longitud;

        return $this;
    }

    public function ver_atributo(Vehiculo $objeto){
        
        echo "Tipo: Camión <br>";
        echo "Color: ". $objeto->getColor(). "<br>
        Peso " . $objeto->getPeso(). " Kg<br>
        Número de puertas: ". $objeto->getNumero_puertas(). " <br>
        Longitud: " . $objeto->getLongitud() . " metros <br>";

    }
}
