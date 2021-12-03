<?php

class Camion extends Cuatro_ruedas {

    private $longitud; 

    public function anadir_remolque($longitud_remolque){
        // TODO
    }

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