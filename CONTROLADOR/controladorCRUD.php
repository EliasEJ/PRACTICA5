<?php
    //Elyass Jerari
    require_once("MODEL/model.php");
    
    function verificarEleccio(){
        if (isset($_POST['eleccio'])){
            //Recogemos los datos del formulario
            $id = htmlspecialchars($_POST['id']);
            $article = htmlspecialchars($_POST['article']);
            $eleccio = $_POST['eleccio']; 

            //Comprobamos si se necesita hacer alguna verificación de los datos
            if($eleccio == "inserir" || $eleccio == "modificar" || $eleccio == "esborrar"){
                compruebaDatos($id, $article, $eleccio);
            }else{
                echo '<div id="resultat" style="color: red;">No has seleccionado ninguna opción</div>';
            }
        }
    }

    /**
     * Comprueba los datos introducidos por el usuario y los envía a la función correspondiente.
     * 
     * @param string $dni El DNI del usuario.
     * @param string $nom El nombre del usuario.
     * @param string $adreca La dirección del usuario.
     * @param string $eleccio La opción seleccionada por el usuario.
     */
    function compruebaDatos($id, $article, $eleccio){
        $falta = [];
        $errors = '';

        if (empty($id)) {
            $falta[] = "ID";
        }
        if (empty($article)) {
            $falta[] = "Article";
        }

        //Comprobamos que los campos no estén vacíos
        if (!empty($id) || !empty($article)) {

            //Mostramos que campos faltan en caso de que falten
            if (!empty($falta)) {
                echo '<div class="faltanDatos">Els següents camps estàn buits: <br>';
                foreach ($falta as $campo) {
                    echo "- $campo <br>";
                }
                echo '<br></div>';
            } elseif (!empty($errors)) {
                echo '<div id="resultat" style="color: red;">' . $errors . '</div>';
            }
            
            //Si no hay errores ni campos vacíos, enviamos los datos a la función correspondiente
            if ($eleccio == "inserir"){
                if (empty($falta) && empty($errors) ) {
                    inserir($article);
                }
            }elseif ($eleccio == "modificar"){
                if (empty($falta) && empty($errors) ) {
                    modificar($id, $article);
                }
            }elseif ($eleccio == "esborrar"){
                if (empty($falta) && empty($errors) ) {
                    esborrar($id);
                }
            }

        }
    }
    //Funciones que guardan el valor de los campos por si ocurre algún error
    function idExist() { if (isset($_POST["id"])) {return $_POST["id"];} }

    function articleExist() {if (isset($_POST["article"])) {return $_POST["article"];} }

?>