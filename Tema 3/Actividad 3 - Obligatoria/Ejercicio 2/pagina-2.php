<?php

session_start();


function checkChars($word)
{

    $chars = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890";

    for ($i = 0; $i < strlen($word); $i++) {

        if (!str_contains($chars, $word[$i])) {

            return false;
        }
    }

    return true;
}

if (isset($_POST['word1']) && $_POST['word1'] == "") {

    $_SESSION['redirect1'] = "empty";
    header('Location: pagina-1.php');

} else if (isset($_POST['word1']) && !checkChars($_POST['word1'])) {

    $_SESSION['redirect1'] = "chars";
    header('Location: pagina-1.php');

} else if (isset($_POST['word1']) && checkChars($_POST['word1'])) {

    $_SESSION['word1'] = $_POST['word1'];
    header('Location: pagina-3.php');
    
}
