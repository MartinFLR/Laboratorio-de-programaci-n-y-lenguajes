<?php
session_start();
require_once 'sessionManager.php';
require_once 'cookieManager.php';
require_once 'user.php';
require_once 'functions.php';

$sessionManager = new SessionManager();
$cookieManager = new CookieManager(7 * 24 * 3600, '/');

$username = null;
$visits = null;


if ($cookieManager->exists('username') &&
    $cookieManager->exists('visits') &&
    $cookieManager->exists('user_id')) {
    
    $user_id = $cookieManager->get('user_id');
    $username = $cookieManager->get('username');

    $visits = $cookieManager->increment('visits');
} else {
    $visits = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Gestor Tareas</title>
</head>
<body>
    <header><h3>Gestor tareas</h3></header>
    <main>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
                    $usernameForm = $_POST['nombre'];
                    $passwordForm = $_POST['password'];
                
                    // Recuperar lista de usuarios
                    $users = $sessionManager->getJson('users', []);
                
                    $foundUser = null;
                
                    // Buscar usuario que coincida con nombre y contraseña
                    foreach ($users as $user) {
                        if ($user['nombre'] === $usernameForm && $user['contra'] === $passwordForm) {
                            $foundUser = $user;
                            break;
                        }
                    }
                
                    if ($foundUser !== null) {
                        // Usuario válido: guardar cookies y redirigir
                        $cookieManager->set('user_id', $foundUser['user_id']);
                        $cookieManager->set('username', $foundUser['nombre']);
                        $cookieManager->set('visits', 0);

                        $_SESSION['userActual'] = $foundUser;
                
                        header('Location: index.php');
                        exit;
                    } else {
                        echo "<p style='color:red;'>Usuario o contraseña incorrectos</p>";
                    }
                }
                
                // Aquí tu código para mostrar formulario o bienvenida
                if ($cookieManager->exists('username')) {
                    echo "<strong>Bienvenido de vuelta $username</strong><br>";
                    echo "<strong>Es tu visita número $visits</strong><br>";
                    echo "<a href='pagTareas.php'>Ir a gestor tareas</a> | ";
                    echo "<a href='cierreSesion.php'>Cerrar Sesion</a>";
                } else {
                    formularioInicioSesion();
                }
            ?>
    </main>
</body>
</html>
