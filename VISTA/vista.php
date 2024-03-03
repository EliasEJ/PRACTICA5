<!-- Elyass Jerari -->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="ESTIL/estils.css"> 
	<title>Paginació</title>
</head>
<body>
<body>
	<div class="header">
			<?php
			require_once 'CONTROLADOR/controlador.php';
			if (isset($_SESSION['user'])) {
				$user = $_SESSION['user'];
				echo "<a href='CONTROLADOR/logout.php'>Logout</a>";
				//echo $user;
				echo "<p>Benvingut " . $user . "</p>";
			} else {
				echo "<button type='submit' value='Login' onclick=\"window.location.href='VISTA/login.vista.php'\">Login</button> 
				<button type='submit' value='Registre' onclick=\"window.location.href='VISTA/registre.vista.php'\">Registrar-se</button>"; 
			}
			?>
	</div>
    <div class="contenidor">
        <h1>Articles</h1>
        <section class="articles">
            <ul>
                <?php
				articles();
				?>
            </ul>
        </section>
		<section class="paginacio">
			<ul>
				<?php 
				paginacio()
				?>
			</ul>
		</section>
		<div>
			<form action="" method="GET">
			<select name="articlesXpag" id="articlesXpag" onchange="this.form.submit()">
				<option value="0">Selecciona el número d'articles per pàgina</option>
				<option value="1">1 article per pàgina</option>
				<option value="5">5 articles per pàgina</option>
				<option value="10">10 articles per pàgina</option>
			</select>
			</form>
		</div>
			<br>
		<div>
		<?php
			if (isset($_SESSION['user'])) {
				$user = $_SESSION['user'];
				CRUD();
				verificarEleccio();
			}
			?>
		</div>

    </div>
</body>
</html>