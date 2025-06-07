<?php
require_once 'functions.php';
require_once 'sessionManager.php';
require_once 'user.php';
require_once 'cookieManager.php';

$sessionManager = new SessionManager();
$cookieManager = new CookieManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['nombre']);
    $password = trim($_POST['password']);

    $user = new User($username, $password);

    $cookieManager->setJson($username, $user->toArray());
    $sessionManager->set('user', $user);
    header('Location: index.php');
    exit;
}
    formularioRegistro();
?>

