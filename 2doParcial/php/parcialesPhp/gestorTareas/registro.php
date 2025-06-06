<?php
require_once 'functions.php';
require_once 'sessionManager.php';
require_once 'user.php';
require_once 'cookieManager.php';

$sessionManager = new SessionManager();
$cookieManager = new CookieManager();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        $user_id = uniqid();
        $username = $_POST['nombre'];
        $password = $_POST['password'];

        // Crear array asociativo en vez de objeto User
        $user = [
            'user_id' => $user_id,
            'nombre' => $username,
            'contra' => $password,
            'tareasActivas' => [],
            'tareasPendientes' => [],
            'tareasFinalizadas' => []
        ];

        // Obtener usuarios existentes o crear nuevo array vacío
        $users = $sessionManager->getJson('users', []);

        // Agregar nuevo usuario al array
        $users[] = $user;

        // Guardar array actualizado en sesión
        $sessionManager->setJson('users', $users);

        // Guardar cookies para mantener sesión
        $cookieManager->set('user_id', $user_id);
        $cookieManager->set('username', $username);
        $cookieManager->set('visits', 0);

        header('Location: index.php');
        exit;
    }

    formularioRegistro();


?>

