<?php
// Elyass Jerari
require_once '../CONTROLADOR/controlador.registre.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="../ESTIL/estils.css"> 
    <title>Registre</title>
    <style>
    </style>
</head>
<body>
    <h1></h1>
    <div class="_container">
    <h2 class="heading">Registre</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="username" id="username">Email</label>
        <input type="email" name="username" value = "<?php echo username() ?>" required><br>
        <label for="password1">Contrasenya</label><br>
        <input type="password" name="password1" value = "<?php echo password() ?>" required><br>
        <label for="password2">Repeteix la contrasenya</label><br>
        <input type="password" name="password2" value = "<?php echo password2() ?>" required><br>
        
        <button type="submit" id="boto" class="bttRegistre">Registre</button>
        <button type='reset' value='Tornar' onclick="window.location.href='../index.php'" class="bttRegistre">Tornar</button>
        <br>
        <?php comprovar()?>
    </form>
    </div>
    
</body>
</html>