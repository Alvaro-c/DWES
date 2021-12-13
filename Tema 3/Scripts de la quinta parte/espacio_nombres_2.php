<?php
namespace Foo\Bar;
include 'fichero1.php';

const FOO = 2;
function foo() {}
class foo
{
    static function método_estático() {}
}

/* Nombre no cualificado */
foo(); // se resuelve con la función Foo\Bar\foo
foo::método_estático(); // se resuelve con la clase Foo\Bar\foo, método método_estático
echo FOO; // se resuelve con la constante Foo\Bar\FOO

/* Nombre cualificado */
subespacio_de_nombres\foo(); // se resuelve con la función Foo\Bar\subespacio_de_nombres\foo
subespacio_de_nombres\foo::método_estático(); // se resuelve con la clase Foo\Bar\subespacio_de_nombres\foo,
                                              // método método_estático
echo subespacio_de_nombres\FOO; // se resuelve con la constante Foo\Bar\subespacio_de_nombres\FOO
                                  
/* Nombre conmpletamente cualificado */
\Foo\Bar\foo(); // se resuelve con la función Foo\Bar\foo
\Foo\Bar\foo::método_estático(); // se resuelve con la clase Foo\Bar\foo, método método_estático
echo \Foo\Bar\FOO; // se resuelve con la constante Foo\Bar\FOO
?>