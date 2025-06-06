<?php
require_once 'functions.php';
require_once 'sessionManager.php';
require_once 'user.php';
require_once 'cookieManager.php';
require_once 'arrayUtils.php';

$sessionManager = new SessionManager();
$cookieManager = new CookieManager();

$foundUser = null;

// Intentamos cargar el usuario actual de la sesión usando SessionManager
$userActualArray = $sessionManager->get('userActual');

if ($userActualArray !== null) {
    $foundUser = User::fromArray($userActualArray);
} else {
    // No está en sesión, buscamos por cookie en la lista de usuarios
    $userId = $cookieManager->get("user_id");
    if ($userId !== null) {
        $users = $sessionManager->getJson('users', []);
        foreach ($users as $userData) {
            if ($userData['user_id'] === $userId) {
                $foundUser = User::fromArray($userData);
                // Guardamos en sesión para próximas peticiones
                $sessionManager->set('userActual', $foundUser->toArray());
                break;
            }
        }
    }
}

if (!$foundUser) {
    die("Usuario no autenticado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ingresarTarea'])) {
    $tarea = $_POST['tarea'];
    $foundUser->agregarTareaPendiente($tarea);

    // Actualizamos la sesión con los datos nuevos
    $sessionManager->set('userActual', $foundUser->toArray());

    // Actualizamos el almacenamiento persistente (archivo JSON)
    $users = $sessionManager->getJson('users', []);
    foreach ($users as $i => $userData) {
        if ($userData['user_id'] === $foundUser->getId()) {
            $users[$i] = $foundUser->toArray();
            break;
        }
    }
    $sessionManager->setJson('users', $users);

    header('Location: pagTareas.php');
    exit;
}

mostrarGestorTareas($foundUser);
volver();
