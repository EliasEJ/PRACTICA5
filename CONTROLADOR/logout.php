<?php
session_start();

// Destruir la sessió
session_destroy();

// Redireccionar a la pàgina principal
header("Location: ../index.php");
exit();
?>