<?php
require_once 'CookieManager.php';

$cookieManager = new CookieManager(0, '/');

$cookieManager->delete("usuario");
$cookieManager->delete("cantidad");
$cookieManager->delete("visitas");

header("Location: index.php");
exit;
