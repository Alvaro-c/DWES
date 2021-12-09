<?php

// Clase Camion
class Camion extends Cuatro_ruedas {

    private $longitud;

    // metodo para añadir un remolque, suma la longitud del remolque a la actual
    public function anadir_remolque($longitud_remolque){
        $this->longitud = $this->longitud + $longitud_remolque;
    }

    // getters y setters
    public function getLongitud()
    {
        return $this->longitud;
    }

    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }
}