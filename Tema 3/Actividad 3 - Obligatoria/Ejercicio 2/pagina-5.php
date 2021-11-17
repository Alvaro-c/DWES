<?php

session_start();

echo "Las palabras coinciden (la palabra es ". $_SESSION['word2'] . ")" ;

session_destroy();