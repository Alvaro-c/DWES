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


if (isset($_POST['word2']) && $_POST['word2'] == "") {

    $_SESSION['redirect2'] = "empty";
    header('Location: pagina-3.php');

} else if (isset($_POST['word2']) && !checkChars($_POST['word2'])) {

    $_SESSION['redirect2'] = "chars";
    header('Location: pagina-3.php');

} else if (isset($_POST['word2']) && checkChars($_POST['word2']) && $_SESSION['word1'] != $_POST['word2']) {

    $_SESSION['word2'] = $_POST['word2'];
    $_SESSION['match'] = false;
    header('Location: pagina-1.php');
    
} else if (isset($_POST['word2']) && checkChars($_POST['word2']) && $_SESSION['word1'] == $_POST['word2']) {

    $_SESSION['word2'] = $_POST['word2'];
    $_SESSION['match'] = true;
    header('Location: pagina-5.php');
}