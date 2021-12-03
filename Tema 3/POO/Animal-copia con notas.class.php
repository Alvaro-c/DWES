 <?php /*
class Animal // palabra clave seguida del nombre de la clase.
{
    // Declaración de atributos, pueden estar vacíos sin un valor por defecto
    private $color = "gris";
    private $peso = 10;

    //constantes de clase
    const PESO_LIGERO = 5;
    const PESO_MEDIO = 10;
    const PESO_PESADO = 15;

    // Declaración de la variable estática $contador
    // Es una variable de la clase, no del objeto, el objeto no lo puede llamar
    private static $contador = 0;

    public static function getContador() {
        return self::$contador;
    }


    //Constructor que solicita 2 argumentos.
    // public function __construct($color, $peso) {
    //     echo 'Llamar al constructor.<br>';
    //     $this->color = $color; // Inicialización del
    //     // color.
    //     $this->peso = $peso; // Inicialización del peso.
    //     self::$contador = self::$contador + 1;
    // }


    // El constructor vacío por defecto se mantiene. 
    // Si quiero mantenerle, pero quiero otro constructor con argumentos, lo puedo hacer de esta manera: 
    // static function crea($color, $peso) {
    //     $instancia = new Animal();
    //     $instancia->peso = $peso;
    //     $instancia->color = $color;
    //     self::$contador = self::$contador + 1; // faltaría hacer el constructor por defecto vacío para que sume 1 en las instancias sin argumentos
    //     return $instancia;
    // }

    // Se puede crear un destructor, pero la función unset(variable) tiene el mismo resultado


    //accesos
    public function getColor() {
        return $this->color; //devuelve el color
    }
    public function setColor($color) {
        $this->color = $color; //escrito en el atributo color
    }
    public function getPeso() {
        return $this->peso; //devuelve el peso
    }
    public function setPeso($peso) {
        $this->peso = $peso; //escrito en el atributo peso
    }
    //métodos
    public function comer() {
        //Método que puede acceder a las propiedades color y peso
    }

    // Ahora este método es una función de la clase, pero no del objeto, por lo que el objeto con this-> no podrá llamarlo
    // Los métodos estáticos no cambian los objetos
    public static function moverse() {
        echo "El animal se mueve.";
    }

    public function añadir_un_kilo() {
        $this->peso = $this->peso + 1;
    }

    public function comer_animal(Animal $animal_comido) {
        //el animal que come aumenta su peso tanto como el del animal comido
        $this->peso = $this->peso + $animal_comido->peso;
        //el peso del animal comido y su color se restablecen a 0
        $animal_comido->peso = 0;
        $animal_comido->color = "";
    }
} */

    abstract class Animal {
        // Declaración de atributos
        private $color = "gris";
        private $peso = 10;
        protected $edad = 0;

        //constantes de clase
        const PESO_LIGERO = 5;
        const PESO_MEDIO = 10;
        const PESO_PESADO = 15;
        // Declaración de la variable estática $contador

        private static $contador = 0;
        public function __construct($color, $peso)
        // Constructor que solicita 2 argumentos.
        {
            echo 'Llamada al constructor.<br>';
            $this->color = $color; // Inicialización del color.
            $this->peso = $peso; // Inicialización del peso.
            self::$contador = self::$contador + 1;
        }
        //accesos

        public function getColor() {
            return $this->color; //devuelve el color
        }
        public function setColor($color) {
            $this->color = $color; //escrito en el atributo color
        }
        public function getPeso() {
            return $this->peso; //devuelve el peso
        }
        public function setPeso($peso) {
            $this->peso = $peso; //escrito en el atributo peso
        }
        //métodos
        public function comer_animal(Animal $animal_comido) {
            //el animal que come aumenta su peso tanto como
            //el del animal comido
            $this->peso = $this->peso + $animal_comido->peso;
            //el peso del animal comido y su color se restablecen a 0
            $animal_comido->peso = 0;
            $animal_comido->color = "";
        }
        public static function moverse() {
            echo "El animal se mueve.";
        }
        public function añadir_un_kilo() {
            $this->peso = $this->peso + 1;
        }

        public static function getContador() {
            return self::$contador;
        }

        abstract public function respira();
    }
