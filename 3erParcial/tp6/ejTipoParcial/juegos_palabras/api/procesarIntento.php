<?php
require_once __DIR__ . '/../clases/GestorJuego.php';
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($_SESSION['gestor'])) {

    http_response_code(400);
    echo json_encode(['error' => 'Partida no iniciada']);
    exit;
}

if (!isset($data['intento'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No se envió intento']);
    exit;
}

$gestor = $_SESSION['gestor'];
$resultado = $gestor->arriesgar($data['intento']);
$_SESSION['gestor'] = $gestor;

echo json_encode($resultado);
