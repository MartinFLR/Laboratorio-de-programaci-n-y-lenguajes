<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

// Recibir parámetros por GET en vez de leer JSON del body
$ciudadOrigen = isset($_GET['ciudadOrigen']) ? trim($_GET['ciudadOrigen']) : null;
$ciudadDestino = isset($_GET['ciudadDestino']) ? trim($_GET['ciudadDestino']) : null;

if (!isset($_SESSION['gestor'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Gestor no encontrado']);
    exit;
}

if ($ciudadOrigen === null || $ciudadDestino === null) {
    http_response_code(400);
    echo json_encode(['error' => 'No fueron enviados los filtros']);
    exit;
}

/** @var GestionViajes */
$gestor = $_SESSION['gestor'];

/** @var Servicio[] */
$servicios = $gestor->filtrar($ciudadOrigen, $ciudadDestino);
$_SESSION['gestor'] = $gestor;

echo json_encode($servicios);
