<?php
setcookie('nueva', "valor", time() + 3600 * 24);
echo $_COOKIE['nueva'];

// La primera vez dará error porque desde el cliente no se ha eviado ninguna cookie (no existe)
// En esa primera llamada, el cliente recibe una cookie del sv
// Por tanto, en la segunda llamada, como sí hay una cookie, ya no da error

// setcookie() envía una cookie del sv al cliente, pero NO se guarda en ningún sitio en el sv