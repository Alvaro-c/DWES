<?php
class Gato extends Animal
{
    private $raza; //raza del gato
    //accesos
    public function getRaza()
    {
        return $this->raza; //devuelve la raza
    }
    public function setRaza($raza)
    {
        $this->raza = $raza; //escrito en el atributo raza
    }
    //método
    public function maullar()
    {
        echo "Miau";
    }
    public function respira()
    {
        echo "El gato respira.<br>";
    }
}
