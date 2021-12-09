<?php

class Coche extends Cuatro_ruedas
{

    private $numero_cadenas_nieve;

    public function setPeso($peso) {

        if ($peso > 2100) {
            echo "Peso demasiado alto <br>";
        }
        return parent::setPeso($peso);


    }

    public function anadir_cadenas_nieve($num) {
        $this->numero_cadenas_nieve = $this->numero_cadenas_nieve + $num;
    }

    public function quitar_cadenas_nieve($num) {
        if ($this->getNumero_cadenas_nieve() >= $num) {
            $this->setNumero_cadenas_nieve($this->getNumero_cadenas_nieve() - $num);

        } else {
            echo "No se puede quitar ese número de cadenas <br>";
        }
    }

    public function getNumero_cadenas_nieve() {
        return $this->numero_cadenas_nieve;
    }

    public function setNumero_cadenas_nieve($numero_cadenas_nieve) {
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
        return $this;
    }

    public function ver_atributo(Vehiculo $objeto) {

        echo "Tipo: Coche <br>";
        echo "Color: " . $objeto->getColor() . "<br>
        Peso " . $objeto->getPeso() . " Kg<br>
        Número de puertas: " . $objeto->getNumero_puertas() . " <br>
        Nº Cadenas de nieve: " . $objeto->getNumero_cadenas_nieve() . " <br>";

    }

    public function anadir_persona($peso_persona) {
        parent::anadir_persona($peso_persona);

        if ($this->getPeso() >= 1500 && $this->getNumero_cadenas_nieve() <= 2) {
            echo "Atención, ponga 4 cadenas para la nieve. <br>";
        }

    }
}
