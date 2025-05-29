<?php
require_once 'gestorJuego.php';
require_once 'cookieManager.php';

$cookieManager = new CookieManager();

$gestorJuego = new GestorJuego($cookieManager->get('cantidad'));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respuesta = trim($_POST['respuesta']);
    
    echo "$gestorJuego->cantidad";
    echo "$respuesta";

}
