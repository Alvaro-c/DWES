<?php

// Clase Camion
class Camion extends Cuatro_ruedas {

    private $longitud;

    // Añade la longitud del parámetro a la longitud del camión
    public function anadir_remolque($longitud_remolque) {
        $this->longitud = $this->longitud + $longitud_remolque;
    }

    // getters y sette
    public function getLongitud() {
        return $this->longitud;
    }

    public function setLongitud($longitud) {
        $this->longitud = $longitud;

        return $this;
    }

    // Método que sustituye al método original del padre para mostrar todos los atributos del camión
    public function ver_atributo(Vehiculo $objeto){
        
        echo "Tipo: Camión <br>";
        echo "Color: ". $objeto->getColor(). "<br>
        Peso " . $objeto->getPeso(). " Kg<br>
        Número de puertas: ". $objeto->getNumero_puertas(). " <br>
        Longitud: " . $objeto->getLongitud() . " metros <br>";

    }
}
