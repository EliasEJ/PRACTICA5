<?php

require '../MODEL/model.php';

// Obtenir el token de la URL
$token = $_GET['token'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaPassword = htmlspecialchars($_POST['novaPassword']);
    $novaPassword2 = htmlspecialchars($_POST['novaPassword2']);

    if ($novaPassword !== $novaPassword2) {
        echo 'Les contrasenyes no coincideixen';
        exit;
    }

    // Obtenir el username a partir del token
    $username = obtenirUsername($token);

    // Obtenir el username i el token creation time a partir del token
    list($username, $tokenCreationTime) = obtenirUsernameITokenCreationTime($token);

    // Verificar si el token té més de 30 minuts
    $currentTime = time();
    $tokenCreationTimestamp = strtotime($tokenCreationTime);

    if ($currentTime - $tokenCreationTimestamp > 1800) { 
        echo 'El token ha caducat, torna a fer la petició de canvi de contrasenya';
        exit;
    }

    $novaPassword = password_hash($novaPassword, PASSWORD_DEFAULT);

    // Obtenir la contrasenya actual de la base de dades
    // $contrasenyaActual = obtenirContrasenya($username);
    // $contrasenyaActual = password_hash($contrasenyaActual, PASSWORD_DEFAULT);

    // echo $contrasenyaActual;
    // echo '<br>';
    // echo $novaPassword;
    // echo '<br>';

    // // Verificar si la nova contrasenya és igual a la contrasenya actual
    // if (password_verify($novaPassword, $contrasenyaActual)) {
    //     echo 'La nova contrasenya no pot ser igual a la contrasenya actual';
    //     exit;
    // }

    // Actualitzar la contrasenya
    canviarPassword($username, $novaPassword);
    echo 'Contrasenya actualitzada amb èxit';
  }
?>