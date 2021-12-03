<?php
class Pez extends Animal {
    private $vive_en_el_mar; //Verdadero si vive en el mar, Falso si no
    //accesos
    public function getTipo() {

        if ($this->vive_en_el_mar) {
            return "vive_en_el_mar";
        } else if ($this->vive_en_el_mar === false) {
            return "no_vive_en_el_mar";
        } else {
            return "";
        }
    }
    public function setTipo($vive_en_el_mar) {
        $this->vive_en_el_mar = $vive_en_el_mar;
        //escrito en el atributo vive_en_el_mar
    }
    //método
    public function nadar() {
        echo "Nado";
    }

    public function mostrarAtributos() {
        echo "Tipo:" . $this->vive_en_el_mar; // correcto ya que es
        // privada de esta clase
        echo "<br>";
        echo "Edad:" . $this->edad; // correcto, ya que el atributo
        // está protegido en la clase madre.
        echo "<br>";
        echo "Peso:" . $this->peso; // error, ya que el atributo es
        //privado en la clase madre, el acceso está prohibido. Debe pasar
        //por sus accesos públicos para modificar o leer su valor
        echo "<br>";
    }


    //metodo sustituido
    public function comer_animal(Animal $animal_comido) {
        // esto reutilia el método de la clase padre y posteriormente se le añade el
        //comportamiento específico de esta subclase
        parent::comer_animal($animal_comido);
        if (isset($animal_comido->raza)) {
            $animal_comido->raza = "";
        }
        if (isset($animal_comido->vive_en_el_mar)) {
            $animal_comido->vive_en_el_mar = "";
        }
    }

    public function respira() {
        echo "El pez respira.<br>";
    }
}
