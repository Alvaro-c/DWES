<?php

// Clase Camion
class Camion extends Cuatro_ruedas {

    private $longitud;

    // Añade la longitud del parámetro a la longitud del camión
    public function anadir_remolque($longitud_remolque) {
        $this->longitud = $this->longitud + $longitud_remolque;
    }

    // getters y setters
    public function getLongitud() {
        return $this->longitud;
    }

    public function setLongitud($longitud) {
        $this->longitud = $longitud;

        return $this;
    }
}
