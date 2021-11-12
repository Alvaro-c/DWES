<?php
setcookie('nueva', "valor", time() + 3600 * 24);
echo $_COOKIE['nueva'];