<?php

class Camion extends Cuatro_ruedas {

    private $longitud; 

    public function anadir_remolque($longitud_remolque){
        $this->longitud = $this->longitud + $longitud_remolque;
    }
}