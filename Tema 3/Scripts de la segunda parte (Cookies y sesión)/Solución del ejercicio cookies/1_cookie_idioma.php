<?php
setcookie('Idioma', $_POST['idioma'], time() + 3600 * 24);
echo "Cookie creada con el valor: ". $_POST['idioma'] ;