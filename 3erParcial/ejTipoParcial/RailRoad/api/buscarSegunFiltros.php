<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['gestor'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Gestor no encontrado']);
    exit;
}

if (!isset($data['ciudadOrigen']) || !isset($data['ciudadDestino'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No fueron enviados los filtros']);
    exit;
}

/** @var GestionViajes */
$gestor = $_SESSION['gestor'];

/** @var Servicio[] */
$servicios = $gestor->filtrar($data['ciudadOrigen'], $data['ciudadDestino']);
$_SESSION['gestor'] = $gestor;


echo json_encode($servicios);
