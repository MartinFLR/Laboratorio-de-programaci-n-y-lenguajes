<?php
require_once 'CookieManager.php';

$cookieManager = new CookieManager(7 * 24 * 3600, '/');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $cantidad = $_POST['cantidad'];

    if (!empty($usuario) && is_numeric($cantidad) && $cantidad > 0) {
        $cookieManager->set("usuario", $usuario);
        $cookieManager->set("cantidad", (string)$cantidad);
    }

    header("Location: index.php");
    exit;
}
