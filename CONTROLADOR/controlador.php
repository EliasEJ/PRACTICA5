<?php
// Elyass Jerari

// Configura el temps de vida de la cookie de sessió
session_set_cookie_params(60);

// Inicia la sessió després de configurar la durada de la cookie
session_start();

require 'MODEL/model.php';
require_once 'CONTROLADOR/controladorCRUD.php';

//Verificar si l' usuari ha iniciat sesió
if (isset($_SESSION['user'])) {
}

// Obtenir numero de la pagina actual i comprovar que es un valor enter positiu
$pagActual = isset($_GET['pagina']) ? abs(intval($_GET['pagina'])) : 1;

// Definir el nùmero d'articles per pàgina
$articlesPagina = isset($_GET['articlesXpag']) ? abs(intval($_GET['articlesXpag'])) : 5;

// Variable que guarda el numero que indica a partir de quin article començar a mostrar
$offset = ($pagActual - 1) * $articlesPagina;

// Consulta SQL para obtener los artículos de la página actual
$articles = obtenirArticles($offset, $articlesPagina, $pdo);

// Consulta SQL para obtener el número total de artículos
$totalArticles = numTotalArticles($pdo);

// Calcular el número total de páginas
$paginesTotals = ceil($totalArticles / $articlesPagina);

/**
 * Funció per mostrar els articles de la pàgina actual
 */
function articles(){
    
    // Definir el nùmero d'articles per pàgina
    $articlesPagina = isset($_GET['articlesXpag']) ? abs(intval($_GET['articlesXpag'])) : 5;

    // Obtenir numero de la pagina actual i comprovar que es un valor enter positiu
    $pagActual = isset($_GET['pagina']) ? abs(intval($_GET['pagina'])) : 1; 

    // Variable que guarda el numero que indica a partir de quin article començar a mostrar
    $offset = ($pagActual - 1) * $articlesPagina;

    // Obtenir la connexió a la base de dades
    $pdo = con();

    // Consulta SQL per obtenir els articles de la pàgina actual
    $articles = obtenirArticles($offset, $articlesPagina, $pdo);

    // Mostrar els articles
    foreach ($articles as $article):
        //echo '<li>' . $article['id'] . '.- ' . $article['article'] ."&nbsp&nbsp&nbsp"."<img src='ESTIL/edit.png'>". "&nbsp&nbsp". "<img src='ESTIL/delete.png'>".'</li>' ;
        echo '<li>' . $article['id'] . '.- ' . $article['article'] .'</li>' ;
    endforeach;
}

/**
 * Funció per mostrar la paginació
 */
function paginacio(){

    // Definir el nùmero d'articles per pàgina
    $articlesPagina = isset($_GET['articlesXpag']) ? abs(intval($_GET['articlesXpag'])) : 5;

    // Obtenir numero de la pagina actual i comprovar que es un valor enter positiu
    $pagActual = isset($_GET['pagina']) ? abs(intval($_GET['pagina'])) : 1;

    // Obtenir la connexió a la base de dades
    $pdo = con();

    // Consulta SQL per obtenir el número total d'articles
    $totalArticles = numTotalArticles($pdo);

    // Calcular el número total de pàgines
    $paginesTotals = ceil($totalArticles / $articlesPagina);

    // Botó per anar a la primera pàgina
    echo '<li><a href="?pagina=1">&laquo</a></li>';

    // Botó per anar a la pàgina anterior
    if ($pagActual > 1) {
        echo '<li><a href="?pagina=' . ($pagActual - 1 ) . '">&lt;</a></li>'; 
    } else {
        echo '<li class="disabled"><a href="#">&lt;</a></li>';
    }

    // Bucle per mostrar les pàgines amb els seus enllaços
    for ($i = 1; $i <= $paginesTotals; $i++) {
        if ($pagActual == $i) {
            echo '<li class="active"><a href="#">' . $i . '</a></li>';
        } else {
            echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Botó per anar a la pàgina següent
    if ($pagActual < $paginesTotals) {
        echo '<li><a href="?pagina=' . ($pagActual + 1). '">&gt;</a></li>'; 
    } else {
        echo '<li class="disabled"><a href="#">&gt;</a></li>';
    }
    
    // Botó per anar a l'última pàgina
    echo '<li><a href="?pagina=' . $paginesTotals . '">&raquo</a></li>';

}

/**
 * Funció per printar formulari CRUD
 */
function CRUD (){
    echo '
    <div>
    <form action="" method="POST">
    <div class="divTable">
    <div class="divTableCell">
    <label for="id">ID:
        <input type="text" name="id" id="id">
    </label><br>
    <label for="article">Article: 
        <input type="text" name="article">
    </label><br>
    </div>
    <div class="divTableCell">
    <label for="eleccio">QUÈ VOLS FER ?: </label><br>
    <label for="inserir">
        <input type="radio" name="eleccio" value="inserir" id="inserir"> INSERIR
    </label><br>
    <label for="modificar">
        <input type="radio" name="eleccio" value="modificar"id="modificar"> MODIFICAR 
    </label><br>
    <label for="esborrar">
        <input type="radio" name="eleccio" value="esborrar" id="esborrar"> ESBORRAR 
    </label><br>
    <br><br>
    
    <button type="submit" class="button">Enviar</button>
    <button type="reset" class="button">Reset</button>
    </div>
    </div>
    </div>
    </form>';
}
?>