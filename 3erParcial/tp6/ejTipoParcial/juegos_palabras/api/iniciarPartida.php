<?php
session_start();
require_once __DIR__ . '/../clases/GestorJuego.php';

$gestor = new GestorJuego();
$gestor->iniciarPartida(); 
$_SESSION['gestor'] = $gestor;

header('Content-Type: application/json');

echo json_encode([
    'mensaje' => 'Partida iniciada',
    'palabra' => $gestor->obtenerInfoInicial()
]);
