<?php
session_start();

include 'cookieManager.php';

$cookie = new CookieManager();

$_SESSION['numeroIngresado'] = '';
$_SESSION['intentos']  = 10;
$_SESSION['cantJuegos']++;

$cookie->set($_SESSION['usuarioLogueado'], $_SESSION['cantJuegos']);

header("Location: paginaPrincipal.php");
exit;
?>