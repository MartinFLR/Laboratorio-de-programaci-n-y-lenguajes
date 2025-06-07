<?php
require_once 'sessionManager.php';
require_once 'user.php';
require_once 'functions.php';
$sessionManager = new SessionManager();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Gestor</title>
</head>
<body>
    <header><h3>Gestor</h3></header>
    <main>
        <?php
        if ($sessionManager->exists('user')){
            $usuario = $sessionManager->get('user');
            echo "<strong>Bienvenido de vuelta  ".$usuario->getNombre()."</strong><br>";
            echo "<a href='pagInicio.php'>Ingresar a pagina</a>";
            echo "<a href='cierreSesion.php'>Cerrar Sesion</a>";
        } else {
            
        formularioInicioSesion();
        }
        ?>
    </main>
</body>
</html>
