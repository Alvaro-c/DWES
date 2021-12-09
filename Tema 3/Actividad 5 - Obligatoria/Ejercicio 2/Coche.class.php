<?php


// Clase Coche
class Coche extends Cuatro_ruedas {

    private $numero_cadenas_nieve;

    // añade las cadenas pasadas por parámetro a las que ya haya
    public function anadir_cadenas_nieve($num) {
        $this->numero_cadenas_nieve = $this->numero_cadenas_nieve + $num;
    }

    // Si hay cadenas suficientes, quitará las pasadas por parámetro, sino muestra un error
    public function quitar_cadenas_nieve($num) {
        if ($this->getNumero_cadenas_nieve() >= $num) {
            $this->setNumero_cadenas_nieve($this->getNumero_cadenas_nieve() - $num);

        } else {
            echo "No se puede quitar ese número de cadenas <br>";
        }
    }

    // getters y setters
    public function getNumero_cadenas_nieve() {
        return $this->numero_cadenas_nieve;
    }

    public function setNumero_cadenas_nieve($numero_cadenas_nieve) {
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
        return $this;
    }
}
