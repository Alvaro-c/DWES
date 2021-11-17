<?php

session_start();

echo "Hola ". $_SESSION['name'] . " ". $_SESSION['apellidos'];