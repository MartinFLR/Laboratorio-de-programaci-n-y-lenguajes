<?php
require_once 'sessionManager.php';
require_once 'functions.php';
require_once 'jugador.php';
require_once 'gestorJuego.php';
$sessionManager = new SessionManager();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Centro numerico</title>
</head>
<body>
    <header><h3>Centro numerico</h3></header>
    <main>
        <?php
        formularioingresoNumero();
        ?>
    </main>
</body>
</html>
