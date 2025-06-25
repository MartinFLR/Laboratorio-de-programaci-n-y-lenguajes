<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

// Recibir parámetros por GET en vez de leer JSON del body
$ciudadOrigen = isset($_GET['ciudadOrigen']) ? trim($_GET['ciudadOrigen']) : null;
$ciudadDestino = isset($_GET['ciudadDestino']) ? trim($_GET['ciudadDestino']) : null;

if ($ciudadOrigen === null || $ciudadDestino === null) {
    http_response_code(400);
    echo json_encode(['error' => 'No fueron enviados los filtros']);
    exit;
}

$gestor = new GestionViajes();

/** @var Servicio[] */
$servicios = $gestor->filtrar($ciudadOrigen, $ciudadDestino);

echo json_encode($servicios);
