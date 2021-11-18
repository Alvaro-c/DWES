<?php

setcookie('PHPSESSID', '', time() - 3600 * 24);

unset($_SESSION);
session_destroy();

header("Location: index.php");