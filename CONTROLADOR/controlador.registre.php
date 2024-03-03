<?php
//Elyass Jerari

require_once '../MODEL/model.php';
require_once '../VISTA/registre.vista.php';

// Inicia la sessió
session_start();

/**
 * Funció per fer les comprovacions del formulari de registre
 */
function comprovar() {
    // Comprova si s'ha enviat el formulari
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obte les dades del formulari
        $username = htmlspecialchars($_POST['username']);
        $password1 = htmlspecialchars($_POST['password1']);
        $password2 = htmlspecialchars($_POST['password2']);

        // Valida les dades
        $errors = [];
        if (empty($username)) {
            $errors[] = "El camp d'usuario es obligatori.";
        }
        if (empty($password1)) {
            $errors[] = "El camp de contrasenya es obligatori.";
        }
        if ($password1 != $password2) {
            $errors[] = "Les contrasenyes no coincideixen.";
        }

        // Comprovar si l'usuari ja existeix
        usuariExisteix($username) ? $errors[] = "L'usuari ja existeix." : null;

        // Si hi ha errors, els mostra i acaba
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        } else {
            // Si no hi ha errors, encripta la contrasenya i registra l'usuari
            $passEnriptada = password_hash($password1, PASSWORD_DEFAULT);
            registre($username, $passEnriptada);
        }
    }
}

/**
 * Funció per mantenir les dades del formulari en cas d'error
 */
function username() { if (isset($_POST["username"])) {return $_POST["username"];} }

/**
 * Funció per mantenir les dades del formulari en cas d'error
 */
function password() {if (isset($_POST["password1"])) {return $_POST["password1"];} }

/**
 * Funció per mantenir les dades del formulari en cas d'error
 */
function password2() {if (isset($_POST["password2"])) {return $_POST["password2"];} }

?>
