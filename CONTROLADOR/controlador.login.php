<?php
//Elyass Jerari
include '../MODEL/model.php';
require_once '../VISTA/login.vista.php';
require '../google-api/vendor/autoload.php';
require_once 'HybridAuth/src/autoload.php';

// Configuració d'inici de sessió amb HybridAuth (GitHub)
$config = [
    'callback' => 'http://localhost/M07_Entorn_Servidor/UF1_Entorn_servidor/PRACTICA5/CONTROLADOR/controlador.login.php?login=github',
    'providers' => [
        'GitHub' => [
            'enabled' => true,
            'keys' => [
                'id' => '156e01e565834feb606b',
                'secret' => 'b330a66108b9f53bf2e4e124fbb7c167dcffa53b'
            ]
        ]
    ]
];
use Hybridauth\Hybridauth;


// Inicia la sessió
session_start();

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('831509465068-jda2jf481cohidmmis9sbplh15cto44h.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/M07_Entorn_Servidor/UF1_Entorn_servidor/PRACTICA5/VISTA/login.vista.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


/**
 * Funció per fer les comprovacions del formulari de login
 */
function comprovar() {
    // Comprova si s'ha enviat el formulari
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obte les dades del formulari
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        // Guardar el nombre d'intents en una cookie.
        if (!isset($_COOKIE['numIntents'])) {
            $numIntents = -1;
            setcookie('numIntents', $numIntents, time() + 3600);
        } else {
            $numIntents = $_COOKIE['numIntents'];
        }

        // Valida les dades
        $errors = [];
        if (empty($username)) {
            $errors[] = "El camp d'usuario es obligatori.";
        }
        if (empty($password)) {
            $errors[] = "El camp de contrasenya es obligatori.";
            $numIntents++;
        }

        // Si hi ha errors, els mostra i acaba
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        } else {
            // Si no hi ha errors fa el login
            login($username, $password);
            // Si la contrasenya es incorrecte incrementa el nombre d'intents
            if (!login($username, $password)) {
                $numIntents++;
                setcookie('numIntents', $numIntents, time() + 60);
            }
            // Si el nombre d'intents es igual a 3, mostra un captcha
            if ($numIntents >= 3) {
                echo '<div class="g-recaptcha" data-sitekey="6LdYWP4oAAAAAHatuy7MghKYp7hdYZTiKI7BtXgo"></div>';
            }
        }
    }
}


if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        $db_connection = con();

        // Storing data into database
        $id = $db_connection->quote($google_account_info->id);
        $full_name = $db_connection->quote(trim($google_account_info->name));
        $email = $db_connection->quote($google_account_info->email);
        $profile_pic = $db_connection->quote($google_account_info->picture);

        // checking if user already exists
        $existing_user = checkIfUserExists($db_connection, $id);
        if ($existing_user) {
            $_SESSION['user'] = $email;
            header('Location: ../index.php');
            exit;
        } else {
            // if user does not exist, insert the user
            $inserted_id = insertUser($db_connection, $id, $email);
            if ($inserted_id) {
                $_SESSION['user'] = $email;
                header('Location: ../index.php');
                exit;
            } else {
                echo "Sign up failed! (Something went wrong).";
            }
        }
    } else {
        header('Location: login.php');
        exit;
    }
}

if (isset($_GET['login']) && $_GET['login'] == 'github') {
        $hybridauth = new Hybridauth($config);
        try {
            $hybridauth->authenticate('GitHub');
            $adapter = $hybridauth->getAdapter('GitHub');
            
            // Obtener información del usuario autenticado con GitHub
            $github_user_info = $adapter->getUserProfile();
    
            // Guardar información en la base de datos
            $github_id = $db_connection->quote($github_user_info->identifier);
            $github_email = $db_connection->quote($github_user_info->email);
    
            // Verificar si el usuario ya existe en la base de datos
            $existing_github_user = checkIfUserExists($db_connection, $github_id);
            if ($existing_github_user) {
                $_SESSION['user'] = $github_email;
                header('Location: ../index.php');
                exit;
            } else {
                // Si el usuario de GitHub no existe, insertarlo en la base de datos
                $inserted_github_id = insertarUserGithub($github_email, $github_id);
                if ($inserted_github_id) {
                    $_SESSION['user'] = $github_email;
                    header('Location: ../index.php');
                    exit;
                } else {
                    echo "GitHub sign up failed! (Something went wrong).";
                }
            }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

/**
 * Funció per mantenir les dades del formulari en cas d'error
 */
function username() { if (isset($_POST["username"])) {return $_POST["username"];} }

/**
 * Funció per mantenir les dades del formulari en cas d'error
 */
function password() {if (isset($_POST["password"])) {return $_POST["password"];} }

?>