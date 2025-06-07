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
            /** @var User $user */
            $user = $sessionManager->get('user');
            $user->incrementarVisitas();
            $sessionManager->set('user', $user);
            echo "<strong>Bienvenido de vuelta  ".$user->getNombre()."</strong><br>";
            echo "<strong>Nos visitaste  ".$user->getVisitas()." Veces!</strong><br>";
            echo "<a href='pagInicio.php'>Ingresar a pagina</a>";
            echo "<a href='cierreSesion.php'>Cerrar Sesion</a>";

        } else {

        formularioInicioSesion();
        }
        ?>
    </main>
</body>
</html>
