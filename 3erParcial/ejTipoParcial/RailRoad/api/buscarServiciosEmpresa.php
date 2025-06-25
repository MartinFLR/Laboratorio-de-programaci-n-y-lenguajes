<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['gestor'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Partida no iniciada']);
    exit;
}

if (!isset($data['idEmpresa'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No se envió intento']);
    exit;
}
/** @var GestionViajes */
$gestor = $_SESSION['gestor'];

/** @var Servicio[] */
$servicios = $gestor->buscarEmpresa($data['idEmpresa']);
$_SESSION['gestor'] = $gestor;


echo json_encode($servicios);