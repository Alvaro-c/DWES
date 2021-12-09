<?php

// Clase camión
class Camion extends Cuatro_ruedas {

    private $longitud; 

    // metodo para añadir un remolque, suma la longitud del remolque a la actual
    public function anadir_remolque($longitud_remolque){
        $this->longitud = $this->longitud + $longitud_remolque;
    }
}